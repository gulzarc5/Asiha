<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;

class ColorController extends Controller
{
    public function  colorList(){
        $colors = Color::orderBy('id','desc')->get();
        return view('admin.color.color_list',compact('colors'));
    }

    public function addColor(){
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.color.add_color_form',compact('category'));
    }

    public function colorInsertForm(Request $request){
        $request->validate([
            'name'=>'required',
            'color'=>'required',
            'category'   => 'required',
            'sub_category'   => 'required',
        ]);
        $colors = Color::create([
            'name'=>$request->input('name'),
            'color'=>$request->input('color'),
            'category_id'=>$request->input('category'),
            'sub_category_id'=>$request->input('sub_category'),
            
        ]);

        if ($colors) {
            return redirect()->back()->with('message','Color Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }

    }

    public function colorEdit($color_id)
    {
        try {
            $id = decrypt($color_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $colors = color::where('id',$id)->first();
        $sub_category = SubCategory::where('category_id',$colors->category_id)->pluck('name', 'id');;
        return view('admin.color.add_color_form',compact('sub_category','category','colors'));
    }

    public function colorUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'color'=>'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            
        ]);
        Color::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'color'=>$request->input('color'),
                'category_id' => $request->input('category'),
                'sub_category_id' => $request->input('sub_category'),
            ]);

            return redirect()->back()->with('message','Color Updated Successfully');
        
    }

    public function colorStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Color::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
