<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
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
       
        $user = User::create([
            'name' => $request['username'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'password' => Hash::make($request['password']),
        ]);
        
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

    public function logout(){
        Auth::guard('user')->logout();        
        $request->session()->invalidate();
        return redirect()->route('web.login_form');
    }

    public function dashboard(){
        return view('web.profile.dashboard');
    }

    public function profile(){
        $user_data = User::where('id',Auth::user()->id)->first();
        return view('web.profile.profile',compact('user_data'));
        
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile'=>'required|numeric|digits:10|unique:users,mobile,'.$id,
        ]);
        $user = User::where('id',Auth::user()->id)->update([
            'name'=>$request['username'],
            'email'=>$request['email'],
            'mobile'=>$request['mobile'],
            'gender'=>$request['gender'],
            'city'=>$request['city'],
            'state'=>$request['state'],
            'pin'=>$request['pin'],
            'address'=>$request['address'],
            'dob'=>$request['dob']

        ]);
        return redirect()->back()->with("message");
    }

    public function address(){
        $user_data = Address::where('user_id',Auth::user()->id)->get();
        return view('web.address.address',compact('user_data'));
    }

    public function addNewAddress(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
            'pin'=>'required'
        ]);
        Address::create([
            'user_id'=>Auth::user()->id,
            'name'=>$request['name'],
            'address'=>$request['address'],
            'state'=>$request['state'],
            'city'=>$request['city'],
            'email'=>$request['email'],
            'mobile'=>$request['mobile'],
            'pin'=>$request['pin'],
            
        ]);
        return redirect()->back()->with('message');
    }

    public function editAddress($id){
        
        $address = Address::where('id',$id)->first();
        
        return view('web.address.edit-address',compact('address'));

    }

    
}
