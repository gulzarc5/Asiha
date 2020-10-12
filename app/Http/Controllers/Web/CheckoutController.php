<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Charges;
use Auth;
use App\Models\Cart;
use Validator;

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



}
