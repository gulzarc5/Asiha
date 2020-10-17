<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailResource;
use App\Models\Brands;
use App\Http\Resources\BrandResource;
use App\Models\Color;
use App\Http\Resources\ColorFilterResource;
use App\Models\Size;
use App\Http\Resources\SizeFilterResource;
use App\Models\ThirdCategory;

class ProductController extends Controller
{
    public function productList($category_id,$type)
    {
        // type 1 = subcategory,2 = third category
        $sub_category = null;
        $product = Product::where('status',1);
        $brands = [];
        $colors = [];
        $sizes = [];
        $price_range = [];

        if ($type == 1) {
            $product = $product->where('sub_category_id',$category_id);
            $brands = $this->BrandFetch($category_id,$category_id,$type);
            $sizes = $this->sizeFetch($category_id,$category_id,$type);
            $colors = $this->colorFetch($category_id,$category_id,$type);
            $sub_category = $category_id;
        } else{
            $cat = ThirdCategory::find($category_id);
            $sub_category = $cat->subCategory->id;
            $product = $product->where('last_category_id',$category_id);
            $brands = $this->BrandFetch($category_id,$sub_category,$type);
            $sizes = $this->sizeFetch($category_id,$sub_category,$type);
            $colors = $this->colorFetch($category_id,$sub_category,$type);
        }
        $total_rows = $product->count();
        $total_page = ceil($total_rows/12);

        $price_query = clone $product;
        $product = $product->orderBy('id','desc')->limit(12)->get();
        if ($product){
            $price_from =$price_query->min('min_price');
            $price_to = $price_query->max('min_price');
            $price_range = [
                'price_from' => $price_from,
                'price_to' => $price_to,
            ];
            $response = [
                'status' => true,
                'message' => 'App Load Api',
                'total_page' => $total_page,
                'current_page' => 1,
                'data' => [
                    'filters' => [
                        [
                            'name' => 'Brands',
                            'id' => '1',
                            'value' => BrandResource::collection($brands),
                        ],
                        [
                            'name' => 'Colors',
                            'id' => '2',
                            'value' => ColorFilterResource::collection($colors),
                        ],
                        [
                            'name' => 'Sizes',
                            'id' => '3',
                            'value' => SizeFilterResource::collection($sizes),
                        ],
                    ],
                    'price_range' => $price_range,
                    'product' => ProductResource::collection($product),
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

    function BrandFetch($category_id,$sub_category,$type){
        $brands = [];
        $brands = Brands::where('sub_category_id',$sub_category)->where('status',1)->get();
        if ($type == 1) {
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
        if ($type == 1) {
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
        if ($type == 1) {
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
                $value->color_code = $color_name->color;
            }
        }
        return $colors;
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
        $product_query = clone $product;
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
            $product = ProductResource::collection($product->get());
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
        $product = Product::find($product_id);
        $related_product = [];
        if ($product) {
            if (!empty($product->last_category_id)) {
                $related_product = Product::where('last_category_id',$product->last_category_id)->inRandomOrder()->limit(10)->get();
            } else {
                $related_product = Product::where('sub_category_id',$product->sub_category_id)->inRandomOrder()->limit(10)->get();
            }

        }
        $response = [
            'status' => true,
            'message' => 'product details',
            'data' =>[
                'product' => new ProductDetailResource($product),
                'related_products' => ProductResource::collection($related_product),
            ],
        ];
        return response()->json($response, 200);
    }
}
