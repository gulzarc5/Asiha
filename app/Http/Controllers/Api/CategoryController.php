<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Category;
use App\Models\CategoryImages;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryImageResource;

use App\Models\SubCategory;
use App\Models\SubCategoryImages;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryWithResource;
use App\Http\Resources\SubCategoryImageResource;

use App\Models\ThirdCategory;
use App\Http\Resources\ThirdCategoryResource;

use App\Models\Slider;
use App\Http\Resources\SliderResource;

use App\Models\Brands;
use App\Http\Resources\BrandResource;



class CategoryController extends Controller
{
    public function appLoadApi()
    {
        $category = Category::where('status',1)->get();
        $banner = Slider::find(1);
        $slider = Slider::where('variant_type',1)->where('slider_type',2)->get();
        $brands = Brands::where('status',1)->get()->random(6);
        $response = [
            'status' => true,
            'message' => 'App Load Api',
            'data' => [
                'category' => CategoryResource::collection($category),
                'banner' => new SliderResource($banner),
                'slider' => SliderResource::collection($slider),
                'brands' => BrandResource::collection($brands),
            ],
        ];
        return response()->json($response, 200);
    }

    public function SubCategoryList($cat_id)
    {
        $sub_cat = SubCategory::where('category_id',$cat_id)->where('status',1)->get();
        $response = [
            'status' => true,
            'message' => 'Second Category List With category',
            'data' => [
                'main_category_image' =>CategoryImageResource::collection(CategoryImages::where('category_id',$cat_id)->get()),
                'sub_category' => SubCategoryWithResource::collection($sub_cat),
            ],
        ];
        return response()->json($response, 200);
    }

    public function LastCategoryList($sub_catrgory_id)
    {
        $third_cat = ThirdCategory::where('sub_category_id',$sub_catrgory_id)->where('status',1)->get();
        $response = [
            'status' => true,
            'message' => 'Third Category List With Sub category',
            'data' => [
                'second_category_image' =>SubCategoryImageResource::collection(SubCategoryImages::where('sub_category_id',$sub_catrgory_id)->get()),
                'third_category' => ThirdCategoryResource::collection($third_cat)
            ],
        ];
        return response()->json($response, 200);
    }
}
