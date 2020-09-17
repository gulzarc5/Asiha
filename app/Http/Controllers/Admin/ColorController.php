<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ColorController extends Controller
{
    public function  colorList(){
        return view('admin.color.color_list');
    }

    public function addColor(){
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.color.add_color_form',compact('category'));
    }
}
