<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Product;
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
    
}
