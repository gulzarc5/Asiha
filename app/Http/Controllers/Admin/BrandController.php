<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brands;

use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function brandList()
    {
        $brands = Brands::orderBy('id','desc')->get();
        return view('admin.brand.brand_list',compact('brands'));
    }

    public function brandAddForm()
    {
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.brand.add_new_brand',compact('category'));
    }

    public function brandInsertForm(Request $request)
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
            $path = base_path().'/public/images/brands/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/brands/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/brands/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/brands/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);
        }

        $brands = Brands::create([
            'name'=>$request->input('name'),
            'category_id'=>$request->input('category'),
            'sub_category_id'=>$request->input('sub_category'),
            'image'=>$image_name,
        ]);

        if ($brands) {
            return redirect()->back()->with('message','Brand Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }
    }

    public function brandEdit($brand_id)
    {
        try {
            $id = decrypt($brand_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $brands = Brands::where('id',$id)->first();
        $sub_category = SubCategory::where('category_id',$brands->category_id)->pluck('name', 'id');;
        return view('admin.brand.add_new_brand',compact('sub_category','category','brands'));
    }

    public function brandUpdate(Request $request,$id)
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
            $cat_prev_image = Brands::where('id',$id)->first();

            $path = base_path().'/public/images/brands/thumb';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/brands/thumb';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('image');
            $destination = base_path().'/public/images/brands/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

           
            $thumb_path = base_path().'/public/images/brands/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = base_path().'/public/images/brands/'.$cat_prev_image->image;
            $prev_img_delete_path_thumb = base_path().'/public/images/brands/thumb/'.$cat_prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

            Brands::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'image'=>$image_name,
                'category_id' => $request->input('category'),
                'sub_category_id' => $request->input('sub_category'),
            ]);

            return redirect()->back()->with('message','Breand Updated Successfully');
        }else{
            Brands::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'category_id' => $request->input('category'),
                'sub_category_id' => $request->input('sub_category'),
            ]);
            return redirect()->back()->with('message','Breand Updated Successfully');
        }
    }

    public function brandStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Brands::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
