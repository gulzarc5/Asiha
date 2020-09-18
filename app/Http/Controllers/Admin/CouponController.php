<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponList(){
        return view('admin.coupon.coupon_list');
    }

    public function addCoupon(){
        return view('admin.coupon.coupon_add_form');
    }
}
