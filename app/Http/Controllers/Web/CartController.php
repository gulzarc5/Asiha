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
                $size_id = $size[0]->size_id;
            }            
        }else{           
            $size_id= $size_id;
        }

        
        if (empty($color)) {
            $colors = ProductColor::where('product_id',$product_id)->first();
            if ($colors) {
                $color = $colors->color_id;
            }
        }
        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)){
            $user_id = Auth::guard('user')->user()->id;

            $check_cart_product = Cart::where('product_id',$product_id)->where('user_id',$user_id)->where('suze_id',$size_id)->count();
 
            if($check_cart_product>0){
                return redirect()->route('web.view_cart');
            }
            
            $cart = new Cart;
            $cart->product_id = $product_id;
            $cart->user_id = Auth::guard('user')->user()->id;
            $cart->colors = $color;
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
        if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)) {
            $cart_data =[];
            // $user_id = Auth::guard('user')->user()->id;
            // $cart = Cart::where('user_id',$user_id)->get();
            // foreach($cart as $values){
            // $cartt = Cart::find($values->id);
            
            // if (count($cart) > 0) {
            //     foreach ($values->product() as $key => $item) {                    
            //         $cart_data[] = [
            //             'product_id' => $cartt->product->id,
            //             'name' => $cartt->product->name,
            //             'image' => $cartt->product->main_image,
            //             'quantity' => $item->quantity,
            //             'size' => $cart->sizes->name,
            //             'price' => $cart->sizes->price,
            //         ];
                    
            //     }
            // }
        // }
        

            return view('web.cart.cart',compact('cart_data'));
        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart_data =[];

                if (count($cart) > 0) {
                    foreach ($cart as $product_id => $value) {
                        $product = DB::table('products')->where('id',$product_id)
                       ->where('status',1)
                        ->first();
                        // $size = DB::table('product_sizes')
                        //     ->select('product_sizes.*','sizes.name as size_name')
                        //     ->join('sizes','sizes.id','=','product_sizes.size_id')
                        //     ->where('size_id',$value['size_id'])
                        //     ->where('product_id',$product_id)
                        //     ->first();
                        
                        $color = DB::table('color')
                            ->where('id',$value['color'])
                            ->first();
                        
                       $cart_data[] = [
                        'product_id' => $product->id,
                        'title' => $product->name,
                        'image' => $product->main_image,
                        'quantity' => $value['quantity'],
                        'color_name' => $color->name,
                        'color_value' => $color->value,
                        'size' => $cart->size->name,
                        'price' => $cart->size->price,
                       ];
                    }
                }else{
                    $cart_data = false;
                }
            }else{
                $cart_data = false;
            }
            // dd($cart_data);
            return view('web.cart',compact('cart_data'));
        }
        return view('web.cart.cart');
    }
   
}



        

