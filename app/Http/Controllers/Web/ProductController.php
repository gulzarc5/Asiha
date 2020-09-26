<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Size;
use App\Models\Brands;
use App\Models\ThirdCategory;
use App\Models\SubCategory;
use App\Models\Color;
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
            $brands = $this->BrandFetch($category_id,$category_id,$type);
            $sizes = $this->sizeFetch($category_id,$category_id,$type);
            $colors = $this->colorFetch($category_id,$category_id,$type);
        }else{
            $product->where('last_category_id',$category_id);
            $third_cat = ThirdCategory::find($category_id);
            $sub_category = $third_cat->sub_category_id;
            $brands = $this->BrandFetch($category_id,$sub_category,$type);
            $sizes = $this->sizeFetch($category_id,$sub_category,$type);
            $colors = $this->colorFetch($category_id,$sub_category,$type);
        }
        $category = ThirdCategory::where('sub_category_id',$sub_category)->where('status',1)->get();

        $query_500 = clone $product;
        $query_1000 = clone $product;
        $query_1500 = clone $product;
        $query_above = clone $product;
        $price_0_500 = $query_500->whereBetween('products.min_price',[0,500])->count();
        $price_0_1000 = $query_1000->whereBetween('products.min_price',[501,1000])->count();
        $price_0_1500 = $query_1500->whereBetween('products.min_price',[1001,1500])->count();
        $price_0_1500 = $query_1500->where('products.min_price','>',1500)->count();
        $products = $product->orderBy('id','desc')->limit(12)->get();

        return view('web.product.product-list',compact('products','category','brands','sizes','category_id','type','price_0_500','price_0_1000','price_0_1500','price_0_1500','sub_cat','third_cat','colors'));
    }

    function BrandFetch($category_id,$sub_category,$type){
        $brands = [];
        $brands = Brands::where('sub_category_id',$sub_category)->where('status',1)->get();
        if ($type == 2) {
            if (isset($brands) && !empty($brands) && (count($brands) > 0)) {
                foreach ($brands as $key => $value) {
                    $value->count = Product::where('sub_category_id', $category_id)->where('status',1)->where('brand_id',$value->id)->count();
                }
            }
        }else{
            if (isset($brands) && !empty($brands) && (count($brands) > 0)) {
                foreach ($brands as $key => $value) {
                    $value->count = Product::where('last_category_id', $category_id)->where('status',1)->where('brand_id',$value->id)->count();
                }
            }
        }
        return $brands;
    }

    function sizeFetch($category_id,$sub_category,$type){
        if ($type == 2) {
            $product_size = Product::where('products.status',1)->where('sub_category_id',$category_id);
        }else{
            $product_size = Product::where('products.status',1)->where('last_category_id',$category_id);
        }
        $product_size->rightJoin('product_sizes','product_sizes.product_id','products.id');

        $product_query = clone $product_size;
        $product_size_query = clone $product_size;

        $sizes = $product_size_query->select('product_sizes.size_id as size_id')->distinct('product_sizes.size_id')->get();


        if (isset($sizes) && !empty($sizes) && (count($sizes) > 0)) {

            foreach ($sizes as $key => $value) {
                $query = clone $product_query;
                $value->product_count = $query->select('products.id as product_id')->where('product_sizes.size_id',$value->size_id)->count();
                $size_name = Size::find($value->size_id);
                $value->size_name = $size_name->name;
            }
        }
        return $sizes;
    }

    function colorFetch($category_id,$sub_category,$type){
        if ($type == 2) {
            $product_color = Product::where('products.status',1)->where('sub_category_id',$category_id);
        }else{
            $product_color = Product::where('products.status',1)->where('last_category_id',$category_id);
        }
        $product_color->rightJoin('product_colors','product_colors.product_id','products.id');

        $product_query = clone $product_color;
        $product_color_query = clone $product_color;

        $colors = $product_color_query->select('product_colors.color_id as color_id')->distinct('product_colors.color_id')->get();


        if (isset($colors) && !empty($colors) && (count($colors) > 0)) {

            foreach ($colors as $key => $value) {
                $query = clone $product_query;
                $value->product_count = $query->select('products.id as product_id')->where('product_colors.color_id',$value->color_id)->count();
                $color_name = Color::find($value->color_id);
                $value->color_name = $color_name->name;
            }
        }
        return $colors;
    }
}
