<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Session;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetalis;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Size;
use App\Models\ProductSize;
use App\Models\Address;
class UserController extends Controller
{
    public function loginForm(){

       return view('web.login');
    }

    public function registerForm(){

       return view('web.register');
    }

    public function register(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'mobile'=>'required|numeric|digits:10|unique:users',
            'password'=>'required|confirmed|min:6'
        ]);
        $user = new User;
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile =$request->input('mobile');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if($user){
            $login = $this->loginCheck($request->input('email'),$request->input('password'));
            if ($login) {
                if (Session::has('cart') && !empty(Session::get('cart'))){
                    $cartt = Session::get('cart');
                    $cart = new Cart;
                    $product_id= key($cartt);
                    $cart->product_id = $product_id;
                    $cart->user_id = Auth::guard('user')->user()->id;
                    $cart->color = $cartt[$product_id]['color'];
                    $cart->quantity =$cartt[$product_id]['quantity'];
                    $cart->size_id =$cartt[$product_id]['size_id'];
                    $cart->save();
                    Session::forget('cart.'.$product_id);
                   }
                return redirect()->intended('/');
            } else {
                return back()->withInput($request->only('email'))->with('login_error',' Mobile / Email or password incorrect');
            }
        }else{
            return redirect()->back()->with("message");
        }
    }

    public function login(Request $request){

        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
        $login = $this->loginCheck($request->input('email'),$request->input('password'));
        if ($login) {
            if (Session::has('cart') && !empty(Session::get('cart'))){
                $cartt = Session::get('cart');
                $cart = new Cart;
                $product_id= key($cartt);
                $cart->product_id = $product_id;
                $cart->user_id = Auth::guard('user')->user()->id;
                $cart->color = $cartt[$product_id]['color'];
                $cart->quantity =$cartt[$product_id]['quantity'];
                $cart->size_id =$cartt[$product_id]['size_id'];
                $cart->save();
                Session::forget('cart.'.$product_id);
               }
            return redirect()->intended('/');
        } else {
            return back()->withInput($request->only('email'))->with('login_error',' Mobile / Email or password incorrect');
        }
    }

    function loginCheck($email,$password){

        $credentials = array(
            'email' => $email,
            'password'  => $password,
            'status'=>1,
        );
        $credential_mobile = array(
            'mobile' => $email,
            'password'  => $password,
            'status'=>1,
        );
        if(Auth::guard('user')->attempt($credentials)) {
            return true;
        }elseif(Auth::guard('user')->attempt($credential_mobile)) {
            return true;
        }else{
            return false;
        }

    }

    public function logout(Request $request){
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        return redirect()->route('web.login_form');
    }

    public function dashboard(){
        return view('web.profile.dashboard');
    }

    public function profile(){
        $user_data = User::find(Auth::user()->id);
        return view('web.profile.profile',compact('user_data'));
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile'=>'required|numeric|digits:10|unique:users,mobile,'.$id,
        ]);
        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->name = $request->input('username');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->gender = $request->input('gender');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->pin = $request->input('pin');
            $user->address = $request->input('address');
            $user->dob = $request->input('dob');
            $user->save();
        }
        return redirect()->back()->with("message",'User Updated Successfully');
    }

    public function address(){
        $address = Address::where('user_id',Auth::user()->id)->get();
        return view('web.address.address',compact('address'));
    }

    public function addNewAddress(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|digits:10|numeric',
            'pin'=>'required'
        ]);
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
        return redirect()->back()->with('message','Address added successfully');
    }

    public function editAddress($id,$status){
        $address = Address::where('id',$id)->first();
        if($status==2){
            return view('web.address.edit-address',compact('address'));
        }
            return view('web.checkout.checkout-edit-address',compact('address'));
    }

    public function updateAddress(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric|digits:10',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pin'=>'required'
        ]);
        $address= Address::find($id);
        if($address){
            $address->name=$request->input('name');
            $address->email=$request->input('email');
            $address->mobile=$request->input('mobile');
            $address->address=$request->input('address');
            $address->city=$request->input('city');
            $address->state=$request->input('state');
            $address->pin=$request->input('pin');
            $address->save();
        }

        return redirect()->back()->with("message",'Address updated successfully');
    }

    public function deleteAddress($address_id){
        Address::destroy($address_id);
        return redirect()->back();
    }

    public function addWishList($product_id){
        $wishlist_cnt = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->count();
        if($wishlist_cnt < 1){
            $wishlist = new wishList();
            if($wishlist){
                $wishlist->user_id = Auth()->user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->save();
            }
        }
        return redirect()->route('web.wishlist');
    }

    public function wishList(){
       $wishlist = Wishlist::where('user_id',Auth::user()->id)->get();
       return view('web.wishlist.wishlist',compact('wishlist'));
    }

    public function removeWishList($id){
        Wishlist::destroy($id);
        return redirect()->back();
    }

    public function myOrderHistory(Request $request){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->limit(30)->get();
        return view('web.order.order',compact('orders'));
    }

    public function orderDetails($id){
        $order_details = OrderDetalis::where('order_id',$id)->get();
        $orders = Order::find($id);
        return view('web.order.order-detail',compact('order_details','orders'));
    }

    public function orderCancel($order_item_id){

        $order_item = OrderDetalis::find($order_item_id);
        $order_item->order_status = 5;
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
        $stock_update = $this->stockUpdate($order_item->product_id,$order_item->quantity,$order_item->size);

        return redirect()->back();
    }

    private function stockUpdate($product_id,$quantity,$size_name){
        // $sizes = Size::where('name',$size_name)->get();

        $size = ProductSize::where('product_sizes.product_id',$product_id)
                ->join('sizes','sizes.id','=','product_sizes.size_id')
                ->where('sizes.name',$size_name)
                ->select('product_sizes.id as id','product_sizes.stock as stock')
                ->first();
        if ($size) {
            $stock_update = ProductSize::find($size->id);
            $stock_update->stock = $stock_update->stock+$quantity;
            $stock_update->save();
        }
        return 1;
    }
}
