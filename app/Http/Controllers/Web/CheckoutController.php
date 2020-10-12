<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Auth;
class CheckoutController extends Controller
{
    public function showCheckoutForm($shipping_charge,$cart_total){
        $shipping_address = Address::where('user_id',Auth::user()->id)->get(); 
        return view('web.checkout.checkout',compact('shipping_address','shipping_charge','cart_total'));
    }


    
}
