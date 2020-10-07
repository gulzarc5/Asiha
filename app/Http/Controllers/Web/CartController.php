<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\Cart;
class CartController extends Controller
{
    public function addCart(Request $request,$product_id){
        $color = $request->input('colors');
        $size_id = $request->input('size_id');
        $quantity = $request->input('quantity');
        
        if (empty($quantity)) {
            $quantity = 1;
        }
        if (empty($size_id)) {
            $size = ProductSize::where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'))
            ->where('product_id',$product_id)
            ->first(); 
            $size_id = $size->size_id;
        }
        if (empty($color)) {
            $colors = ProductColor::where('product_id',$product_id)->first(); 
            $color = $colors->color_id;
        }

        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)){
            $user_id = Auth::guard('user')->user()->id;

            $check_cart_product = Cart::where('product_id',$product_id)
            ->where('user_id',$user_id)
            ->count();
            if($check_cart_product){
                if($check_cart_product>0){
                   return redirect()->route('web.view_cart');
            }
        }
        $cartt = new Cart;
            $cartt->product_id = $product_id;
            $cartt->user_id = Auth::guard('user')->user()->id;
            $cartt->color_id = $color;
            $cartt->quantity =$quantity;
            $cartt->size_id =$size_id;
            $cartt->created_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
        return redirect()->route('web.view_Cart');
        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart[$product_id] =[
                     'quantity' => $quantity,
                     'color' => $color,
                     'size_id'=>$size_id,
                 ];
            }else{
                $cart = [
                    $product_id => [
                     'quantity' => $quantity,
                     'color' => $color,
                     'size_id'=>$size_id,
                    ],
                ];
            }
            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart');
        }

    }
   
}



        

