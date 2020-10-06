<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use App\Models\Order;
use App\Http\Resources\CouponResource;

use App\Models\Cart;
use App\Models\Charges;
use App\Models\OrderDetalis;
use Validator;
use DB;

class OrderController extends Controller
{
    public function couponFetch($user_id)
    {
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

    public function placeOrder(Request $request)
    {
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
        $order_details->quantity = $cart->quantity;
        $order_details->price = $size_fetch->price;
        $order_details->mrp = $size_fetch->mrp;
        $order_details->discount = $coupon_percentage;

        if ($order_details->save()) {
            return true;
        } else {
            throw new Exception;
        }
    }
}
