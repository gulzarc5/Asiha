<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function AddProductForm(){
        $data = DB::table('category')->get();
        return view('admin.product.add_product_form',['category'=>$data]);
    }

    public function ListProducts(){
        return view('admin.product.list_all_products');
    }
}
