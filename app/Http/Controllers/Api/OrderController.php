<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use App\Models\Order;
use App\Http\Resources\CouponResource;
use App\Http\Resources\OrderHistoryResource;

use App\Models\Cart;
use App\Models\Charges;
use App\Models\OrderDetalis;
use App\Models\RefundInfo;
use Validator;
use DB;

class OrderController extends Controller
{
    public function couponFetch($user_id){
        $coupons = Coupon::where('id',1)->where('status',1)->first();
        $check_user = Order::where('user_id',$user_id)->where('order_status',4)->count();
        if ($check_user > 0) {
            $coupons = Coupon::where('id',2)->where('status',1)->first();
        }
        $response = [
            'status' => true,
            'message' => 'App Load Api',
            'data' => new CouponResource($coupons),
        ];
        return response()->json($response, 200);

    }

    public function couponApply(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required',
            'coupon_code' => 'required', // 1 = cod, 2 = online
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $coupon = $request->input('coupon_code');
        $user_id = $request->input('user_id');
        $coupons = Coupon::where('code',$coupon)->where('status',1)->first();
        if ($coupons) {
            $check_user = Order::where('user_id',$user_id)
                ->where(function($q){
                    $q->where('order_status',1)->orWhere('order_status',2)->orWhere('order_status',3)->orWhere('order_status',4);
                })
                ->count();
            if(($coupons->usertype == 1) && ($check_user == 0) ){
                $response = [
                    'status' => true,
                    'message' => 'coupon',
                    'error_code' => false,
                    'error_message' => null,
                    'data' => $coupons,
                ];
                return response()->json($response, 200);
            }elseif (($coupons->usertype == 2)) {
                $response = [
                    'status' => true,
                    'message' => 'coupon',
                    'error_code' => false,
                    'error_message' => null,
                    'data' => $coupons,
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'message' => 'coupon Invalid',
                    'error_code' => false,
                    'error_message' => null,
                ];
                return response()->json($response, 200);
            }

        } else {
            $response = [
                'status' => false,
                'message' => 'coupon Invalid',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

    }

    public function placeOrder(Request $request){
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required',
            'payment_type' => 'required', // 1 = cod, 2 = online
            'shipping_address_id' => 'required',
        ]);

        $user_id = $request->input('user_id');
        $payment_type = $request->input('payment_type');
        $shipping_address_id = $request->input('shipping_address_id');
        $coupon = $request->input('coupon_id');

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $payment_status = 1; // 1 = cod, 2 = Pay Online
        $total_amount = 0;
        $order_id = null;
        try {
            DB::transaction(function () use($user_id,$payment_type,$shipping_address_id,$coupon,&$payment_status,&$total_amount,&$order_id) {

                $coupon_percentage = 0 ;
                if (isset($coupon) && !empty($coupon)) {
                    $coupon = Coupon::where('id',$coupon)->where('status',1)->first();
                    if ($coupon) {
                        $coupon_percentage = $coupon->discount ;
                    }
                }

                $order = new Order();
                $order->user_id = $user_id;
                $order->shipping_address_id = $shipping_address_id;
                $order->payment_type = $payment_type;
                if ($payment_type == '2') {
                    $order->payment_status = 3;
                    $payment_status = 2;
                }
                $order->user_id = $user_id;

                if ($order->save()) {
                    $order_id = $order->id;
                    $cart = Cart::where('user_id',$user_id)->get();
                    foreach ($cart as $key => $cart_data) {
                        $product_size = $cart_data->sizes;
                        $total_amount +=  ($cart_data->quantity*$product_size->price);
                        $this->orderDetailsInsert($cart_data,$product_size,$user_id,$order->id,$coupon_percentage);
                    }

                    $min_order_amount_fetch = Charges::where('id',1)->where('status',1)->first();
                    $shipping_charge_fetch = Charges::where('id',2)->where('status',1)->first();
                    $shipping_charge = 0;
                    if ($min_order_amount_fetch && $shipping_charge_fetch) {
                        if ($min_order_amount_fetch->amount >= $total_amount) {
                            $shipping_charge = $shipping_charge_fetch->amount;
                        }
                    }

                    $order->shipping_charge = $shipping_charge;
                    $discount = 0;
                    if ($coupon_percentage > 0) {
                        $discount = (($coupon_percentage * $total_amount) / 100);
                    }
                    $order->discount = $discount;
                    $order->amount = $total_amount;
                    $order->total_amount = (($total_amount - $discount) + $shipping_charge);
                    $order->save();
                    $total_amount =  (($total_amount - $discount) + $shipping_charge);


                } else {
                    throw new Exception;
                }

            });

            $response = [
                'status' => true,
                'message' => 'Order Place',
                'error_code' => false,
                'error_message' => null,
                'data' => [
                    'order_id' => $order_id,
                    'payment_status' => $payment_status,
                    'amount' => $total_amount,
                ],
            ];
            return response()->json($response, 200);
        }catch (\Exception $e) {
            // dd($e);
            $response = [
                'status' => false,
                'message' => 'Sorry We Can\'t Place Your Order Please Try After Sometime',
                'error_code' => false,
                'error_message' => null,
                'data' => [],
            ];
            return response()->json($response, 200);
        }
    }

    function orderDetailsInsert($cart,$size_fetch,$user_id,$order_id,$coupon_percentage){
        $order_details = new OrderDetalis();
        $order_details->user_id = $user_id;
        $order_details->order_id = $order_id;
        $order_details->product_id = $cart->product_id;
        $order_details->size = $size_fetch->size->name;
        $order_details->color = $cart->color;
        $order_details->quantity = $cart->quantity;
        $order_details->price = $size_fetch->price;
        $order_details->mrp = $size_fetch->mrp;
        $order_details->discount = $coupon_percentage;

        if ($order_details->save()) {
            $this->stockUpdate($order_details->product_id,$order_details->quantity,$order_details->size,1);
            return true;
        } else {
            throw new Exception;
        }
    }

    private function stockUpdate($product_id,$quantity,$size_name,$type){
        // $sizes = Size::where('name',$size_name)->get();
        $size = ProductSize::where('product_sizes.product_id',$product_id)
                ->join('sizes','sizes.id','=','product_sizes.size_id')
                ->where('sizes.name',$size_name)
                ->select('product_sizes.id as id','product_sizes.stock as stock')
                ->first();
        if ($size) {
            $stock_update = ProductSize::find($size->id);
            if ($type == '1') {
                $stock_update->stock = $stock_update->stock-$quantity;
            } else {
                $stock_update->stock = $stock_update->stock+$quantity;
            }

            $stock_update->save();
        }
        return 1;
    }

    public function orderCancel($order_item_id)
    {
        $order_item = OrderDetalis::find($order_item_id);
        $order_item->order_status = 5;
        $order_item->save();

        $this->stockUpdate($order_item->product_id,$order_item->quantity,$order_item->size,2);

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();
        $response = [
            'status' => true,
            'message' => 'Order Cancelled',
        ];
        return response()->json($response, 200);
    }

    public function orderCancelRefund(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'order_item_id' => 'required',
            'name'   => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'ac_no' => 'required',
            'ifsc' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $order_item_id = $request->input('order_item_id');
        $order_item = OrderDetalis::find($order_item_id);
        $order_item->order_status = 5;
        $order_item->refund_request = 2;
        $order_item->save();

        $this->stockUpdate($order_item->product_id,$order_item->quantity,$order_item->size,2);

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();

        $amount = $order_item->quantity*$order_item->price;
        $discount = (($amount*$order_item->discount)/100);
        if ($status == 5 || $status == 6 || $status == 7 ) {
            $order_item->refund_amount = (($amount-$discount)+$order_item->order->shipping_charge);
        }else{
            $order_item->refund_amount = ($amount-$discount);
        }
        $order_item->save();

        $refund_info = new RefundInfo();
        $refund_info->order_id = $order_item->id;
        $refund_info->amount =  $order_item->refund_amount;
        $refund_info->name = $request->input('name');
        $refund_info->bank_name = $request->input('bank_name');
        $refund_info->ac_no = $request->input('ac_no');
        $refund_info->ifsc = $request->input('ifsc');
        $refund_info->branch_name = $request->input('branch_name');
        $refund_info->save();

        $response = [
            'status' => true,
            'message' => 'Order Cancelled Successfully',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }

    public function orderReturnRefund(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'order_item_id' => 'required',
            'name'   => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'ac_no' => 'required',
            'ifsc' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $order_item_id = $request->input('order_item_id');
        $order_item = OrderDetalis::find($order_item_id);
        $order_item->order_status = 6;
        $order_item->refund_request = 2;
        $order_item->save();

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();

        $amount = $order_item->quantity*$order_item->price;
        $discount = (($amount*$order_item->discount)/100);
        if ($status == 5 || $status == 6 || $status == 7 ) {
            $order_item->refund_amount = (($amount-$discount)+$order_item->order->shipping_charge);
        }else{
            $order_item->refund_amount = ($amount-$discount);
        }
        $order_item->save();

        $refund_info = new RefundInfo();
        $refund_info->order_id = $order_item->id;
        $refund_info->amount =  $order_item->refund_amount;
        $refund_info->name = $request->input('name');
        $refund_info->bank_name = $request->input('bank_name');
        $refund_info->ac_no = $request->input('ac_no');
        $refund_info->ifsc = $request->input('ifsc');
        $refund_info->branch_name = $request->input('branch_name');
        $refund_info->save();

        $response = [
            'status' => true,
            'message' => 'Return Request Sent Successfully',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }

    public function paymentVerify(Request $request){
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required',
            'razorpay_order_id' => 'required', // 1 = normal, 2 = Express
            'razorpay_payment_id' => 'required', // 1 = cod, 2 = online
            'razorpay_signature' => 'required',
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
                'data' => [],
            ];
            return response()->json($response, 200);
        }

        $verify = $this->signatureVerify(
            $request->input('razorpay_order_id'),
            $request->input('razorpay_payment_id'),
            $request->input('razorpay_signature')
        );
        if ($verify) {
            $order = Order::find($request->input('order_id'));
            $order->payment_id =  $request->input('razorpay_payment_id');
            $order->payment_status = 2;
            $order->save();
            $response = [
                'status' => true,
                'message' => 'Payment Success',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Payment Failed',
            ];
            return response()->json($response, 200);
        }
    }


    public function orderHistory($user_id)
    {
        $orders = Order::where('user_id',$user_id)->get();
        $response = [
            'status' => true,
            'message' => 'Order History',
            'data' => OrderHistoryResource::collection($orders),
        ];
        return response()->json($response, 200);
    }
}
