<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ThirdCategory;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $category = Category::get();
        return view('admin.category.category_list',compact('category'));
    }

    public function categoryAddForm()
    {
        return view('admin.category.add_new_category');
    }

    public function categoryInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image_name = null;
        if($request->hasfile('image'))
        {
           
            $path = base_path().'/public/images/category/category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $category = Category::create([
            'name'=>$request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'image'=>$image_name,
        ]);

        if ($category) {
            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
        
    }

    public function categoryStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function categoryEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('id',$id)->first();
        return view('admin.category.add_new_category',compact('category'));
    }

    public function categoryUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $image_name = null;
        if($request->hasfile('image'))
        {
            $cat_prev_image = Category::where('id',$id)->first();

            $path = base_path().'/public/images/category/category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/category/category/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/category/category/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            Category::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
                'image'=>$image_name,
            ]);

            return redirect()->back()->with('message','Category Updated Successfully');
        }else{
            Category::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);
            return redirect()->back()->with('message','Category Updated Successfully');
        }
    }


    //////////////////////////////////Sub Category /////////////////////////////

    public function subCategoryList()
    {
        $sub_category = SubCategory::get();

        return view('admin.category.sub_category_list',compact('sub_category'));
    }

    public function subCategoryAddForm()
    {
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.category.add_new_sub_category',compact('category'));
    }

    public function subCategoryInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image_name = null;
        if($request->hasfile('image'))
        {
           
            $path = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/sub_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/sub_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $sub_category = SubCategory::create([
            'name'=>$request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'category_id'=>$request->input('category'),
            'image'=>$image_name,
        ]);

        if ($sub_category) {
            Category::where('id',$request->input('category'))->update([
                'is_sub_category'=>2,
            ]);
            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function subCategoryEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $sub_category = SubCategory::where('id',$id)->first();
        return view('admin.category.add_new_sub_category',compact('sub_category','category'));
    }

    public function subCategoryUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $image_name = null;
        if($request->hasfile('image'))
        {
            $cat_prev_image = SubCategory::where('id',$id)->first();

            $path = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/sub_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/sub_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/sub_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/category/sub_category/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/category/sub_category/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            SubCategory::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
                'image'=>$image_name,
                'category_id' => $request->input('category'),
            ]);

            return redirect()->back()->with('message','Sub Category Updated Successfully');
        }else{
            SubCategory::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
                'category_id' => $request->input('category'),
            ]);
            return redirect()->back()->with('message','Sub Category Updated Successfully');
        }
    }

    public function subCategoryStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = SubCategory::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function subCategoryListWithCategory($category_id)
    {
        $sub_category = SubCategory::where('category_id',$category_id)->where('status',1)->get();
        return $sub_category;
    }



    ///////////////Third category////////////

    public function thirdCategoryList()
    {
        $third_category = ThirdCategory::get();
        return view('admin.category.third_category_list',compact('third_category'));
    }

    public function thirdCategoryAddForm()
    {
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.category.add_new_third_category',compact('category'));
    }

    public function thirdCategoryInsertForm(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image_name = null;
        if($request->hasfile('image'))
        {           
            $path = base_path().'/public/images/category/third_category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/third_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/third_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/third_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $third_category = ThirdCategory::create([
            'name'=>$request->input('name'),
            'sub_category_id'=>$request->input('sub_category'),
            'image'=>$image_name,
        ]);

        if ($third_category) {
            SubCategory::where('id',$request->input('sub_category'))->update([
                'is_sub_category'=>2,
            ]);
            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function thirdCategoryEdit($third_cat_id)
    {
        try {
            $id = decrypt($third_cat_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $third_category = ThirdCategory::where('id',$id)->first();
        $sub_category = SubCategory::where('category_id',$third_category->subCategory->category_id)->pluck('name', 'id');;
        return view('admin.category.add_new_third_category',compact('sub_category','category','third_category'));
    }

    public function thirdCategoryUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $image_name = null;
        if($request->hasfile('image'))
        {
            $cat_prev_image = ThirdCategory::where('id',$id)->first();

            $path = base_path().'/public/images/category/third_category/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/category/third_category/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/category/third_category/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/category/third_category/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/category/third_category/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/category/third_category/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            ThirdCategory::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'image'=>$image_name,
                'sub_category_id' => $request->input('sub_category'),
            ]);

            return redirect()->back()->with('message','third Category Updated Successfully');
        }else{
            ThirdCategory::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'sub_category_id' => $request->input('sub_category'),
            ]);
            return redirect()->back()->with('message','third Category Updated Successfully');
        }
    }

    public function thirdCategoryStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = ThirdCategory::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function thirdCategoryListWithSubCategory($sub_category_id)
    {
        $third_category = ThirdCategory::where('sub_category_id',$sub_category_id)->where('status',1)->get();
        return $third_category;
    }

}
