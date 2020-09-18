<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon; 

class CouponController extends Controller
{
    public function couponList(){
        $coupons = Coupon::orderBy('id','desc')->get();
        return view('admin.coupon.coupon_list',compact('coupons'));
    }

    public function addCoupon(){
        return view('admin.coupon.coupon_add_form');
    }

    public function couponInsertForm(Request $request){
           
            $this->validate($request, [
                'code'   => 'required',
                'user_type'=>'required'
                
            ]);

            $coupons = Coupon::create([
                'code'=>$request->input('code'),
                'usertype'=>$request->input('user_type'),
            ]);
            if ($coupons) {
                return redirect()->back()->with('message','Coupon Added Successfull');
            } else {
                return redirect()->back()->with('error','Something Wrong Please Try again');
            }
    }

    public function couponEdit($coupon_id)
    {
        try {
            $id = decrypt($coupon_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $coupons = Coupon::where('id',$id)->first();
        return view('admin.coupon.coupon_add_form',compact('coupons'));
    }

    public function couponUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'code'   => 'required',
            'user_type'   => 'required',
            
        ]);
        Coupon::where('id',$id)
            ->update([
                'code'=>$request->input('code'),
                'usertype' => $request->input('user_type'),
                
            ]);
            return redirect()->back()->with('message','Coupon Updated Successfully');
        }

    public function couponStatus($id,$status){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Coupon::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
    

}
