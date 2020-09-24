<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Product;
use App\Models\Brands;
use App\Models\Color;
use App\Models\Size;
use App\Models\Thirdcategory;

class ProductController extends Controller
{
    public function productList($category_id,$type)
    {
        // type 1 = subcategory,2 = third category
        $sub_category = null;
        $product = Product::where('status',1);
        if ($type == 1) {
            $product = $product->where('sub_category_id',$category_id);
            $sub_category = $category_id;
        } else{
            $cat = Thirdcategory::find($category_id);
            $sub_category = $cat->subCategory->id;
            $product = $product->where('last_category_id',$category_id);
        }
        
        $total_rows = $product->count();
        $total_page = ceil($total_rows/12);
        $brands = [];
        $colors = [];
        $sizes = [];
        $price_range = [];

        $product = $product->orderBy('id','desc')->limit(12)->get();
        if ($product){
            if (!empty($sub_category)) {
                
                $brands = Brands::where('sub_category_id',$sub_category)->where('status',1)->get();
                $colors = Color::where('sub_category_id',$sub_category)->where('status',1)->get();
                $sizes = Size::where('sub_category_id',$sub_category)->where('status',1)->get();
                $price_from =$product->min('min_price');
                $price_to = $product->max('min_price');
                $price_range = [
                    'price_from' => $price_from,
                    'price_to' => $price_to,
                ];
            }
            $response = [
                'status' => true,
                'message' => 'App Load Api',
                'total_page' => $total_page,
                'current_page' => 1,
                'data' => [
                    'brands' => $brands,
                    'colors' => $colors,
                    'sizes' => $sizes,
                    'price_range' => $price_range,
                    'product' => $product,
                ],
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => true,
                'message' => 'App Load Api',
                'total_page' => $total_page,
                'current_page' => 1,
                'data' => [],
            ];    	
            return response()->json($response, 200);
        }

       
    }
    public function productListWithFilter(Request $request){
        $validator =  Validator::make($request->all(),[
	        'category_id' => 'required',
	        'page' => 'required',
            'type' => 'required', // 1 = subcategory,2 = third category 
	        'brand' => 'array',
	        'color' => 'array',
	        'size' => 'array',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }

        $category_id = $request->input('category_id');
        $page = $request->input('page');
        if (!isset($page) || empty($page)) {
            $page = 1;
        }
        $type = $request->input('type');
        $brand = $request->input('brand'); // array of brand
        $brand = isset($brand) ? $brand : [];
        $color = $request->input('color'); // array of Color
        $color = isset($color) ? $color : [];
        $size = $request->input('size'); // array of Size
        $size = isset($size) ? $size : [];
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        $sort = $request->input('sort');

        $product = Product::where('products.status',1);
        if ($type == 1) {
            $product->where('sub_category_id',$category_id);
        } else {
            $product->where('last_category_id',$category_id);
        }
        if (count($brand) > 0) {
            $product->where(function($q) use ($brand) {
                $brand_count = true;
                foreach ($brand as $key => $brands) {
                    if (isset($brands) && !empty($brands)) {                        
                        if ($brand_count) {
                            $q->where('products.brand_id',$brands);
                            $brand_count = false;
                        }else{
                            $q->orWhere('products.brand_id',$brands);
                        }
                    }
                } 
            });
        }
        if (count($size) > 0) {
            $size_count = true;
            foreach ($size as $key => $sizes) {
                if (isset($sizes) && !empty($sizes)) { 
                    $product->whereIn('id',function($q) use ($sizes,$size_count) {
                        $q->select('product_id')->from('product_sizes');
                        if ($size_count) {
                            $q->where('product_sizes.size_id',$sizes);
                            $size_count = false;
                        }else{
                            $q->orWhere('product_sizes.size_id',$sizes);
                        }
                    });
                }
            } 
        }
        if (count($color) > 0) {
                $color_count = true;
                foreach ($color as $key => $colors) {      
                    if (isset($colors) && !empty($colors)) { 
                        $product->whereIn('id',function($q) use ($colors,$color_count) {
                            $q->select('product_id')->from('product_colors');
                            if ($color_count) {
                                $q->where('product_colors.color_id',$colors);
                                $color_count = false;
                            }else{
                                $q->orWhere('product_colors.color_id',$colors);
                            }
                        });
                    }
                } 
        }
        if (!empty($price_from) && !empty($price_to)) {
            $product->whereBetween('products.min_price',[$price_from,$price_to]);
        }
        $product_query = $product;
        $total_product = $product->count('products.id');
        $total_page = intval(ceil($total_product / 12 ));
        $limit = ($page*12)-12;

        if ($total_product > 0) {
            
            $product =$product_query->skip($limit)->take(12);
            if (isset($sort) && !empty($sort)) {
                //Sort By Newest
                if ($sort == '1') {
                    $product->orderBy('products.id', 'desc');
                }
                // Sort By Low Price
                elseif ($sort == '2') {
                    $product->orderBy('products.min_price', 'asc');
                }
                // Sort By High Price
                elseif ($sort == '3') {
                    $product->orderBy('products.min_price', 'desc');
                }
                // Sort By Title Asc
                elseif ($sort == '4') {
                    $product->orderBy('products.name', 'asc');
                }
                // Sort By Title Desc
                elseif ($sort == '5') {
                    $product->orderBy('products.name', 'desc');
                }
            }
            $product = $product->get();
            $message = "product List";
        }else{
            $product = [];
            $message = "No Products Found";
        }

        $response = [
            'status' => true,
            'current_page' =>$page,
            'total_page' =>$total_page,
            'total_product' =>$total_product,
            'message' => $message,
            'data' => $product,    
        ];    	
        return response()->json($response, 200);
    }

    public function singleProductView($product_id)
    {
        $product = Product::with('category','subCategory','thirdCategory','brand','sizes','productColors')->find($product_id);
        $response = [
            'status' => true,
            'message' => 'product details',
            'data' => $product,    
        ];    	
        return response()->json($response, 200);
    }
}
