<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Charges;
use App\Models\Coupon;
use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetalis;
use Validator;
use DB;
use Exception;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function showCheckoutForm(){
        $cart_total = 0;
        $shipping_charge = 0;

        $charge_boundary = Charges::where('id',1)->first();
        $ship_charge = Charges::where('id',2)->first();
        $user_id = Auth::guard('user')->user()->id;
        $shipping_address = Address::where('user_id',$user_id)->get();

        $cart = Cart::where('user_id',$user_id)->get();
            foreach($cart as $cart_item){
                $size = $cart_item->sizes;
                $cart_total += $cart_item->quantity*($size->price);
            }
            if($cart_total < $charge_boundary->amount){
                $shipping_charge = $ship_charge->amount;
            }

        return view('web.checkout.checkout',compact('shipping_address','shipping_charge','cart_total'));
    }

    public function addCheckoutAddress(Request $request){
        $validator =  Validator::make($request->all(),[
            'name'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|digits:10|numeric',
            'pin'=>'required'
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

        $address = new address();
        if($address){
            $address->user_id=Auth::user()->id;
            $address->name=$request->input('name');
            $address->address=$request->input('address');
            $address->state=$request->input('state');
            $address->city=$request->input('city');
            $address->email=$request->input('email');
            $address->mobile=$request->input('mobile');
            $address->pin=$request->input('pin');
            $address->save();
        }
        $shipping_address = Address::where('user_id',Auth::user()->id)->get();
        $response = [
            'status' => true,
            'data' => $shipping_address,
        ];
        return response()->json($response, 200);
    }

    public function couponApply(Request $request)
    {
        $coupon = $request->input('coupon');
        $coupons = Coupon::where('code',$coupon)->where('status',1)->first();
        $user_id = Auth::user()->id;
        if ($coupons) {
            $check_user = Order::where('user_id',$user_id)->where('order_status',1)->orWhere('order_status',2)->orWhere('order_status',3)->orWhere('order_status',4)->count();
            if(($coupons->usertype == 1) && ($check_user == 0) ){
                $response = [
                    'status' => true,
                    'message' => 'coupon',
                    'data' =>$coupons,
                ];
                return response()->json($response, 200);
            }elseif (($coupons->usertype == 2)) {
                $response = [
                    'status' => true,
                    'message' => 'coupon',
                    'data' =>$coupons,
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'message' => 'coupon Invalid',
                ];
                return response()->json($response, 200);
            }

        } else {
            $response = [
                'status' => false,
            ];
            return response()->json($response, 200);
        }

    }

    public function orderPlace(Request $request)
    {
        $this->validate($request,[
            'address_id'=>'required',
            'payment_type'=>'required',
        ]);
        $address_id = $request->input('address_id');
        $payment_type = $request->input('payment_type');
        $coupon_id = $request->input('coupon_id');



        $total_amount = 0;
        $discount_percent = 0;
        $order_id = null;
        $user_id = Auth::user()->id;
        if (!empty($coupon_id)) {
            $discount_fetch = $this->fetchDiscount($user_id,$coupon_id);
            if ($discount_fetch['status'] == true) {
                $discount_percent = $discount_fetch['data'];
            }
        }

        $charge_boundary = Charges::where('id',1)->first();
        $ship_charge = Charges::where('id',2)->first();

        try{
            DB::transaction(function () use($user_id,$discount_percent,$payment_type,$address_id,$charge_boundary,$ship_charge,&$total_amount,&$order_id) {
                $order = new Order();
                $order->user_id = $user_id;
                $order->shipping_address_id = $address_id;
                $order->payment_type = $payment_type;
                if ($payment_type == '2') {
                    $order->payment_status = 3;
                }
                $order->save();
                if ($order) {
                    $order_id = $order->id;
                    $cart = Cart::where('user_id',$user_id)->get();
                    foreach ($cart as $key => $cart_data) {
                        $size = $cart_data->sizes;
                        $this->orderDetailsInsert($cart_data,$size,$user_id,$order_id,$discount_percent);
                        $total_amount += $cart_data->quantity*($size->price);
                    }
                    $order->discount = ($discount_percent > 0) ? ($total_amount*$discount_percent)/100 : 0;
                    $order->amount = $total_amount;
                    $ship_charge = ($charge_boundary->amount > $total_amount) ? $ship_charge->amount : 0;
                    $order->shipping_charge = $ship_charge;
                    $order->total_amount = $total_amount + $ship_charge - $order->discount;
                    $order->save();
                }else{
                    throw new Exception;
                }

            });
            // $data = [
            //     'total_amount' => $total_amount,
            //     'order_id' => $order_id,
            // ];
            if ($payment_type == 1) {
               return redirect()->route('web.checkout.confirm-order');
            } else {
                $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
                $order = $api->order->create(array(
                    'receipt' => $order_id,
                    'amount' => $total_amount*100,
                    'currency' => 'INR',
                    )
                );
                $order_update = Order::find($order_id);
                $order_update->payment_request_id = $order['id'];
                $order_update->save();

                $response = [
                    'key_id' => config('services.razorpay.id'),
                    'amount' => $total_amount*100,
                    'order_id' => $order['id'],
                    'name' => $order_update->user->name,
                    'email' => $order_update->user->email,
                    'mobile' => $order_update->user->mobile,
                ];
                return view('web.checkout.ra-payment',compact('response'));
            }

        }catch(\Exception $e){
            return redirect()->back();
        }
    }

    public function paySuccess(Request $request)
    {
        $verify = $this->signatureVerify(
            $request->input('signature'),
            $request->input('paymentId'),
            $request->input('orderId')
        );
        if ($verify) {
            $order = Order::where('payment_request_id',$request->input('orderId'))->first();
            $order->payment_id = $request->input('paymentId');
            $order->payment_status = 2;
            $order->save();
        }
        return redirect()->route('web.checkout.confirm-order',['status'=>$verify]);
    }

    private function signatureVerify($signature,$payment_id,$order_id)
    {
        try {
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $attributes = array(
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            );

            $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (\Exception $e) {
            $success = false;
        }
        return $success;
    }

    function fetchDiscount($user_id,$coupon_id)
    {
        $coupons = Coupon::where('id',$coupon_id)->where('status',1)->first();
        $user_id = Auth::user()->id;
        if ($coupons) {
            $check_user = Order::where('user_id',$user_id)->where('order_status',1)->orWhere('order_status',2)->orWhere('order_status',3)->orWhere('order_status',4)->count();
            if(($coupons->usertype == 1) && ($check_user == 0) ){
                $response = [
                    'status' => true,
                    'data' =>$coupons->discount,
                ];
                return $response;
            }elseif (($coupons->usertype == 2)) {
                $response = [
                    'status' => true,
                    'message' => 'coupon',
                    'data' =>$coupons->discount,
                ];
                return $response;
            }else{
                $response = [
                    'status' => false,
                    'message' => 'coupon Invalid',
                ];
                return $response;
            }

        } else {
            $response = [
                'status' => false,
            ];
            return $response;
        }
    }

    function orderDetailsInsert($cart,$size,$user_id,$order_id,$discount_percent){
        $order_details = new OrderDetalis();
        $order_details->user_id = $user_id;
        $order_details->order_id = $order_id;
        $order_details->product_id = $cart->product_id;
        $order_details->size = $size->size->name;
        $order_details->color = !empty($color = $cart->colors) ? $color->color : null;
        $order_details->quantity = $cart->quantity;
        $order_details->price = $size->price;
        $order_details->mrp = $size->mrp;
        $order_details->discount = $discount_percent;
        if ($order_details->save()) {
            return true;
        } else {
            throw new Exception;
        }
    }
}
