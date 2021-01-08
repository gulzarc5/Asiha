<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\Charges;
use App\Models\Size;
use Carbon\Carbon;

use Session;

class CartController extends Controller
{
    public function addDirectCart(Request $request,$product_id){

        $color = $request->input('color');
        $size_id = $request->input('size_id');
        $quantity = $request->input('quantity');
        if (empty($quantity)) {
            $quantity = 1;
        }else{
            $quantity = $quantity;
        }
        $product = Product::find($product_id);
        if(empty($size_id)) {
            $size = $product->minSize;
            if (!empty($size) && count($size) > 0) {
                $size_id = $size[0]->id;
            }
        }else{
            $size_id= $size_id;
        }
// dd($size_id);

        if (empty($color)) {
            $colors = ProductColor::where('product_id',$product_id)->first();
            if ($colors) {
                $color = $colors->color_id;
            }
        }
        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)){
            $user_id = Auth::guard('user')->user()->id;

            $check_cart_product = Cart::where('product_id',$product_id)->where('user_id',$user_id)->where('size_id',$size_id)->count();

            if($check_cart_product>0){
                return redirect()->route('web.view_cart');
            }

            $cart = new Cart;
            $cart->product_id = $product_id;
            $cart->user_id = Auth::guard('user')->user()->id;
            $cart->color = $color;
            $cart->quantity =$quantity;
            $cart->size_id =$size_id;
            $cart->save();
            return redirect()->route('web.view_cart');
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
            return redirect()->route('web.view_cart');
        }
    }

    public function viewCart(){
        $cart_total = 0;
        $shipping_charge = 0;
        $cart_data =[];
        $charge_boundary = Charges::where('id',1)->first();
        $ship_charge = Charges::where('id',2)->first();

        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)) {

            $user_id = Auth::guard('user')->user()->id;
            $cart = Cart::where('user_id',$user_id)->get();
            foreach($cart as $cart_item){

                $size = $cart_item->sizes;

                $cart_total += $cart_item->quantity*($size->price);

                $color = !empty($cart_item->colors) ? $cart_item->colors->color : null ;
                $cart_data[] = [
                    'cart_id'=>$cart_item->id,
                    'product_id' => $cart_item->product->id,
                    'slug' => $cart_item->product->slug,
                    'name' => $cart_item->product->name,
                    'image' => $cart_item->product->main_image,
                    'quantity' => $cart_item->quantity,
                    'color'=>$color,
                    'size' => $size->size->name,
                    'price' => $size->price,
                    'product_total'=> $size->price*$cart_item->quantity,
                ];
            }
            if($cart_total < $charge_boundary->amount){
                $shipping_charge = $ship_charge->amount;
            }
            return view('web.cart.cart',compact('cart_data','cart_total','shipping_charge'));

        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))){
                $cart = Session::get('cart');

                if (!empty($cart) && (count($cart) > 0)) {
                    foreach ($cart as $product_id => $cart_item) {
                        $product =Product::find($product_id);
                        $color = !empty($cart_item['color']) ? Color::where('id',$cart_item['color'])->first() : null;
                        $color = !empty($color) ? $color->color : null;
                        $product_size = ProductSize::where('id',$cart_item['size_id'])->first();
                        $cart_total += $cart_item['quantity']*$product_size->price;

                        $cart_data[] = [
                            'product_id' => $product_id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'image' => $product->main_image,
                            'quantity' => $cart_item['quantity'],
                            'size' => $product_size->size->name,
                            'price' => $product_size->price,
                            'color'=> $color,
                            'product_total'=>$product_size->price * $cart_item['quantity']
                        ];

                    }

                    if($cart_total < $charge_boundary->amount){
                        $shipping_charge = $ship_charge->amount;
                    }
                }
            }
            return view('web.cart.cart',compact('cart_data','cart_total','shipping_charge'));
        }
    }

    public function removeCart($id){
        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)){
        Cart::where('product_id',$id)->delete();
        return redirect()->back();
        }
        elseif(Session::has('cart') && !empty(Session::get('cart'))){
            Session::forget('cart.'.$id);
            return redirect()->back();
        }
        return redirect()->route('web.view_cart');
    }

    public function updateCart($id,$cart_id,$qtty){
       $cart = Cart::find($cart_id);
       $cart->quantity = $qtty;
       $cart->save();
       return redirect()->back();
    }

    public function updateSessionCart($id,$qtty){
        $cart = Session::get('cart');
        $cart[$id]['quantity']=$qtty;
        Session::put('cart',$cart);
        Session::save();
        return redirect()->back();
     }



}





