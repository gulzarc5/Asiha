<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Size;
use App\Models\Brands;
use App\Models\ThirdCategory;
use App\Models\SubCategory;
class ProductController extends Controller
{
    public function productlist($slug,$category_id,$type){
        $product = Product::where('status',1);
        $category = null;
        $brands = null;
        $sizes = null;
        $price_range = [
            'min' => 0,
            'max' => 0,
        ];
        $sub_cat = null;
        $third_cat = null;
        if ($type == 2) {
            $product->where('sub_category_id',$category_id);
            $sub_category = $category_id;
            $sub_cat = SubCategory::find($sub_category);
        }else {
            $product->where('last_category_id',$category_id);
            $third_cat = ThirdCategory::find($category_id);
            $sub_category = $third_cat->sub_category_id;
        }
        $category = ThirdCategory::where('sub_category_id',$sub_category)->where('status',1)->get();
        $brands = Brands::where('sub_category_id',$sub_category)->where('status',1)->get();
        $sizes = Size::where('sub_category_id',$sub_category)->where('status',1)->get();
        $query_500 = clone $product;
        $query_1000 = clone $product;
        $query_1500 = clone $product;
        $query_above = clone $product;
        $price_0_500 = $query_500->whereBetween('products.min_price',[0,500])->count();
        $price_0_1000 = $query_1000->whereBetween('products.min_price',[501,1000])->count();
        $price_0_1500 = $query_1500->whereBetween('products.min_price',[1001,1500])->count();
        $price_0_1500 = $query_1500->where('products.min_price','>',1500)->count();
        $products = $product->orderBy('id','desc')->limit(12)->get();

        return view('web.product.product-list',compact('products','category','brands','sizes','type','price_0_500','price_0_1000','price_0_1500','price_0_1500','sub_cat','third_cat'));
    }



}
