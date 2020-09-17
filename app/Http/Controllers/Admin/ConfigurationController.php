<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;

class ConfigurationController extends Controller
{
    public function sizeAddForm()
    {
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.sizes.add_new_size',compact('category'));
    }

    public function sizeList()
    {
        $sizes = Size::get();
        return view('admin.sizes.size_list',compact('sizes'));
    }

    public function sizeInsert(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
        ]);

        $brands = Size::create([
            'name'=>$request->input('name'),
            'category_id'=>$request->input('category'),
            'sub_category_id'=>$request->input('sub_category'),
        ]);

        if ($brands) {
            return redirect()->back()->with('message','Size Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function sizeEdit($size_id)
    {
        try {
            $id = decrypt($size_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $sizes = Size::where('id',$id)->first();
        $sub_category = SubCategory::where('category_id',$sizes->category_id)->pluck('name', 'id');;
        return view('admin.sizes.add_new_size',compact('sub_category','category','sizes'));
    }

    public function sizeUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
        ]);

        Size::where('id',$id)
        ->update([
            'name'=>$request->input('name'),
            'category_id' => $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
        ]);
        return redirect()->back()->with('message','Size Updated Successfully');
    }

    public function sizeStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Size::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }


}
