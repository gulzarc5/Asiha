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
use Validator;

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
        $p_query = clone $product;
        $price_0_500 = $query_500->whereBetween('products.min_price',[0,500])->count();
        $price_0_1000 = $query_1000->whereBetween('products.min_price',[501,1000])->count();
        $price_0_1500 = $query_1500->whereBetween('products.min_price',[1001,1500])->count();
        $price_0_1500 = $query_1500->where('products.min_price','>',1500)->count();
        $total_product = $p_query->count();
        $total_page = intval(ceil($total_product / 12 ));
        $products = $product->orderBy('id','desc')->limit(12)->get();

        return view('web.product.product-list',compact('products','category','brands','sizes','category_id','type','price_0_500','price_0_1000','price_0_1500','price_0_1500','sub_cat','third_cat','colors','total_page'));
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

    public function productListWithFilter(Request $request){
        $validator =  Validator::make($request->all(),[
	        'category' => 'required',// 2 = subcategory,3 = third category
	        'type' => 'required',
            'price_range' => 'array',
	        'colors' => 'array',
	        'brand' => 'array',
            'sizes' => 'array',
            'sort' => 'required',
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

        $price_range = $request->input('price_range');
        $price_range = isset($price_range) ? $price_range : [];

        $category_id = $request->input('category');
        $page = $request->input('page');
        if (!isset($page) || empty($page)) {
            $page = 1;
        }
        $type = $request->input('type');
        $brand = $request->input('brand'); // array of brand
        $brand = isset($brand) ? $brand : [];
        $color = $request->input('colors'); // array of Color
        $color = isset($color) ? $color : [];
        $size = $request->input('sizes'); // array of Size
        $size = isset($size) ? $size : [];
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

        if (count($price_range) > 0) {
            $product->where(function($q) use ($price_range) {
                $price_count = true;
                foreach ($price_range as $key => $price_ranges) {
                    if (isset($price_ranges) && !empty($price_ranges)) {
                        if ($price_count) {
                            if ($price_ranges == '1') {
                                $q->whereBetween('products.min_price',[0,500]);
                            } elseif ($price_ranges == '2') {
                                $q->whereBetween('products.min_price',[501,1000]);
                            } elseif ($price_ranges == '3') {
                                $q->whereBetween('products.min_price',[1001,1500]);
                            }else{
                                $q->where('products.min_price','>',1500);
                            }
                        } else {
                            if ($price_ranges == '1') {
                                $q->orWhereBetween('products.min_price',[0,500]);
                            } elseif ($price_ranges == '2') {
                                $q->orWhereBetween('products.min_price',[501,1000]);
                            } elseif ($price_ranges == '3') {
                                $q->orWhereBetween('products.min_price',[1001,1500]);
                            }else{
                                $q->orWhere('products.min_price','>',1500);
                            }
                        }
                    }
                    $price_count = false;
                }
            });
        }

        $product_query = clone $product;
        $total_product = $product->count('products.id');
        $total_page = intval(ceil($total_product / 12 ));
        $limit = ($page*12)-12;

        if ($total_product > 0) {
            if (isset($sort) && !empty($sort)) {
                //Sort By Newest
                if ($sort == 'latest') {
                    $product_query->orderBy('products.id', 'desc');
                }
                // Sort By Low Price
                elseif ($sort == 'price_low') {
                    $product_query->orderBy('products.min_price', 'asc');
                }
                // Sort By High Price
                elseif ($sort == 'price_high') {
                    $product_query->orderBy('products.min_price', 'desc');
                }
                // Sort By Title Asc
                elseif ($sort == 'title_asc') {
                    $product_query->orderBy('products.name', 'asc');
                }
                // Sort By Title Desc
                elseif ($sort == 'title_desc') {
                    $product_query->orderBy('products.name', 'desc');
                }
            }

            $products =$product_query->skip($limit)->take(12)->get();
            if ($page == 1) {
                return view('web.product.product_pagination_list_page',compact('products','total_page','page'));
            } else {
               $data = [
                'products' => $products,
                'total_page' => $total_page,
                'page' => $page,
               ];
               return response()->json($data, 200);
            }

        }else{
            $products = [];
            return view('web.product.product_pagination_list_page',compact('products','total_page','page'));
        }
    }

    public function productDetails($slug,$product_id){
        $product = Product::find($product_id);
        return view('web.product.product-detail',compact('product'));
    }
}
