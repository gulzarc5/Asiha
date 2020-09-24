<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Category;
use App\Models\Slider;
use App\Models\ThirdCategory;
use App\Models\Brands;

class CategoryController extends Controller
{
    public function appLoadApi()
    {
        $category = Category::with('subCategory')->where('status',1)->get();
        $banner = Slider::find(1);
        $slider = Slider::where('variant_type',1)->where('slider_type',2)->get();
        $brands = Brands::where('status',1)->get()->random(6);
        $response = [
            'status' => true,
            'message' => 'App Load Api',
            'data' => [
                'category' => $category,
                'banner' => $banner,
                'slider' => $slider,
                'brands' => $brands,
            ],
        ];    	
        return response()->json($response, 200);
    }

    public function LastCategoryList($sub_catrgory_id)
    {
        $third_cat = ThirdCategory::where('sub_category_id',$sub_catrgory_id)->where('status',1)->get();
        $response = [
            'status' => true,
            'message' => 'App Load Api',
            'data' => $third_cat,
        ];    	
        return response()->json($response, 200);
    }
}
