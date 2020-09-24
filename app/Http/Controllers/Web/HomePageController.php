<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ThirdCategory;
class HomePageController extends Controller
{
    public function index(){
        $slider = Slider::where('variant_type',2)->where('slider_type',2)->get();
        $category = Category::where('status',1)->get();
        foreach ($category as $key => $main_cat) {
            $main_cat->sub_category = [];
            if ($main_cat->is_sub_category == '2') {
                $main_cat->sub_category = SubCategory::where('status',1)->where('category_id',$main_cat->id)->inRandomOrder()->limit(10)->get();
                $main_cat->sub_category;
                foreach ($main_cat->sub_category as $key => $sub_cat) {
                    if ($sub_cat->is_sub_category == '2') {
                        $sub_cat->third_category = ThirdCategory::where('status',1)->where('sub_category_id',$sub_cat->id)->inRandomOrder()->limit(10)->get();
                    }
                }
            }
        }
        return view('web.index',compact('slider','category'));        
    }

   
}
