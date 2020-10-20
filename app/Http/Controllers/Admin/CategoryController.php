<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ThirdCategory;
use File;
use App\Models\CategoryImages;
use App\Models\SubCategoryImages;
use App\Models\ThirdLevelCategoryImages;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categoryList(){
        $category = Category::get();
        return view('admin.category.category_list',compact('category'));
    }

    public function categoryAddForm(){
        return view('admin.category.add_new_category');
    }

    public function categoryInsertForm(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->input('name');
        $category = new Category();
        $category->slug = Str::slug($request->input('name'), '-');
        $category->name=$name;
        if ($category->save()) {
        if ($request->hasFile('images')) {
            $banner=null;
            for ($i = 0; $i < count($request->file('images')); $i++) {
                $image = $request->file('images')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();
                if ($i == 0) {
                    $banner = $image_name;
                }
                //Category Original Image
                $destinationPath = base_path() . '/public/images/category/category/';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);
                //Category Image Thumbnail
                $destination = base_path() . '/public/images/category/category/thumb/';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                $category_image = new CategoryImages();
                $category_image->image = $image_name;
                $category_image->category_id = $category->id;
                $category_image->save();
            }

            $category->image = $banner;
            $category->save();

        }


            return redirect()->back()->with('message','Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }

    }

    public function categoryStatus($id,$status){
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

    public function categoryEdit($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('id',$id)->first();
        return view('admin.category.add_new_category',compact('category'));
    }


    public function categoryUpdate(Request $request,$id){
        $this->validate($request, [
            'name'   => 'required'

        ]);
        Category::where('id',$id)
            ->update([
                'name'=>$request->input('name'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);
            return redirect()->back()->with('message','Category Updated Successfully');

    }

    public function imagesEdit($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category_images = CategoryImages::where('category_id',$id)->get();
        $category = Category::find($id);
        return view('admin.category.images',compact('category_images','category'));
    }

    public function makeImageCover($category_id, $image_id){
        $image = CategoryImages::find($image_id);
        if ($image) {
            Category::where('id', $category_id)->update([
                'image' => $image->image,
            ]);
        }
        return redirect()->back();
    }

    public function deleteImage($image_id){
        $image = CategoryImages::where('id', $image_id)->first();
        if ($image) {
            $path = base_path() . '/public/images/category/category/' . $image->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $path_thumb = base_path() . '/public/images/category/category/thumb/' . $image->image;
            if (File::exists($path_thumb)) {
                File::delete($path_thumb);
            }
        }
        CategoryImages::where('id', $image_id)->delete();
        return redirect()->back();
    }

    public function addNewImages(Request $request){
        $path = base_path() . '/public/images/category/category/';
        File::exists($path) or File::makeDirectory($path, 0777, true, true);
        $path_thumb = base_path() . '/public/images/category/category/thumb/';
        File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        $category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            for ($i = 0; $i < count($request->file('image')); $i++) {
                $image = $request->file('image')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

                //Product Original Image
                $destinationPath = base_path() . '/public/images/category/category';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);

                //Product Thumbnail
                $destination = base_path() . '/public/images/category/category/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                CategoryImages::create([
                    'image' => $image_name,
                    'category_id' => $category_id,
                ]);
            }
        }
        return redirect()->back();
    }

    //////////////////////////////////Sub Category /////////////////////////////

    public function subCategoryList(){
        $sub_category = SubCategory::get();

        return view('admin.category.sub_category_list',compact('sub_category'));
    }

    public function subCatimagesEdit($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $sub_category_images = SubCategoryImages::where('sub_category_id',$id)->get();
        $sub_category = SubCategory::find($id);
        return view('admin.category.images',compact('sub_category_images','sub_category'));
    }

    public function makeSubCatImageCover($sub_category_id, $image_id){
        $image = SubCategoryImages::find($image_id);
        if ($image) {
            SubCategory::where('id', $sub_category_id)->update([
                'image' => $image->image,
            ]);
        }
        return redirect()->back();
    }

    public function deleteSubCatImage($image_id){
        $image = SubCategoryImages::where('id', $image_id)->first();
        if ($image) {
            $path = base_path() . '/public/images/category/sub_category/' . $image->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $path_thumb = base_path() . '/public/images/category/sub_category/thumb/' . $image->image;
            if (File::exists($path_thumb)) {
                File::delete($path_thumb);
            }
        }
        SubCategoryImages::where('id', $image_id)->delete();
        return redirect()->back();
    }
    public function subCategoryAddForm(){
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.category.add_new_sub_category',compact('category'));
    }

    public function subCategoryInsertForm(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'category'=>'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->input('name');
        $sub_category = new SubCategory();
        $sub_category->slug = Str::slug($request->input('name'), '-');
        $sub_category->category_id = $request->input('category');
        $sub_category->name=$name;
        if ($sub_category->save()) {
        if ($request->hasFile('images')) {
            $banner=null;
            for ($i = 0; $i < count($request->file('images')); $i++) {
                $image = $request->file('images')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();
                if ($i == 0) {
                    $banner = $image_name;
                }
                //Category Original Image
                $destinationPath = base_path() . '/public/images/category/sub_category/';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);
                //Category Image Thumbnail
                $destination = base_path() . '/public/images/category/sub_category/thumb/';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                $sub_category_image = new SubCategoryImages();
                $sub_category_image->image = $image_name;
                $sub_category_image->sub_category_id = $sub_category->id;
                $sub_category_image->save();
            }

            $sub_category->image = $banner;
            $sub_category->save();

        }


            return redirect()->back()->with('message','Sub Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }

    }

    public function subCategoryEdit($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $category = Category::where('status',1)->pluck('name', 'id');
        $sub_category = SubCategory::where('id',$id)->first();
        return view('admin.category.add_new_sub_category',compact('sub_category','category'));
    }

    public function subCategoryUpdate(Request $request,$id){
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

    public function subCategoryStatus($id,$status){
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

    public function subCategoryListWithCategory($category_id){
        $sub_category = SubCategory::where('category_id',$category_id)->where('status',1)->get();
        return $sub_category;
    }

    public function subCatNewImages(Request $request){
        $path = base_path() . '/public/images/category/sub_category/';
        File::exists($path) or File::makeDirectory($path, 0777, true, true);
        $path_thumb = base_path() . '/public/images/category/sub_category/thumb/';
        File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        $sub_category_id = $request->input('sub_category_id');

        if ($request->hasFile('image')) {
            for ($i = 0; $i < count($request->file('image')); $i++) {
                $image = $request->file('image')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

                //Product Original Image
                $destinationPath = base_path() . '/public/images/category/sub_category';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);

                //Product Thumbnail
                $destination = base_path() . '/public/images/category/sub_category/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                SubCategoryImages::create([
                    'image' => $image_name,
                    'sub_category_id' => $sub_category_id,
                ]);
            }
        }
        return redirect()->back();
    }



    ///////////////Third category////////////

    public function thirdCategoryList(){
        $third_category = ThirdCategory::get();
        return view('admin.category.third_category_list',compact('third_category'));
    }

    public function thirdCategoryAddForm(){
        $category = Category::where('status',1)->pluck('name', 'id');
        return view('admin.category.add_new_third_category',compact('category'));
    }

    public function ThirdCategoryInsertForm(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'sub_category'=>'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->input('name');
        $third_category = new ThirdCategory();
        $third_category->slug = Str::slug($request->input('name'), '-');
        $third_category->sub_category_id = $request->input('sub_category');
        $third_category->name=$name;
        if ($third_category->save()) {
        if ($request->hasFile('images')) {
            $banner=null;
            for ($i = 0; $i < count($request->file('images')); $i++) {
                $image = $request->file('images')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();
                if ($i == 0) {
                    $banner = $image_name;
                }
                //Category Original Image
                $destinationPath = base_path() . '/public/images/category/third_category/';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);
                //Category Image Thumbnail
                $destination = base_path() . '/public/images/category/third_category/thumb/';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                $third_category_image = new ThirdLevelCategoryImages();
                $third_category_image->image = $image_name;
                $third_category_image->third_category_id = $third_category->id;
                $third_category_image->save();
            }

            $third_category->image = $banner;
            $third_category->save();

        }


            return redirect()->back()->with('message','Third Level Category Added Successfull');
        } else {
            return redirect()->back()->with('error','Something Wrong Please Try again');
        }

    }

    public function thirdCategoryEdit($third_cat_id){
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

    public function thirdLevelimagesEdit($id){

        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();

        }
        $third_level_images = ThirdLevelCategoryImages::where('third_category_id',$id)->get();
        $third_level_category = ThirdCategory::find($id);

        return view('admin.category.images',compact('third_level_images','third_level_category'));
    }

    public function deletethirdCatImage($image_id){
        $image = ThirdLevelCategoryImages::where('id', $image_id)->first();
        if ($image) {
            $path = base_path() . '/public/images/category/third_category/' . $image->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $path_thumb = base_path() . '/public/images/category/third_category/thumb/' . $image->image;
            if (File::exists($path_thumb)) {
                File::delete($path_thumb);
            }
        }
        ThirdLevelCategoryImages::where('id', $image_id)->delete();
        return redirect()->back();
    }

    public function thirdCatNewImages(Request $request){
        $path = base_path() . '/public/images/category/third_category/';
        File::exists($path) or File::makeDirectory($path, 0777, true, true);
        $path_thumb = base_path() . '/public/images/category/third_category/thumb/';
        File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        $third_category_id = $request->input('sub_category_id');

        if ($request->hasFile('image')) {
            for ($i = 0; $i < count($request->file('image')); $i++) {
                $image = $request->file('image')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

                //Product Original Image
                $destinationPath = base_path() . '/public/images/category/third_category';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);

                //Product Thumbnail
                $destination = base_path() . '/public/images/category/third_category/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                ThirdLevelCategoryImages::create([
                    'image' => $image_name,
                    'third_category_id' => $third_category_id,
                ]);
            }
        }
        return redirect()->back();
    }

    public function makeThirdCatImageCover($third_category_id, $image_id){
        $image = ThirdLevelCategoryImages::find($image_id);
        if ($image) {
            ThirdCategory::where('id', $third_category_id)->update([
                'image' => $image->image,
            ]);
        }
        return redirect()->back();
    }

    public function thirdCategoryUpdate(Request $request,$id){
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
        ]);

        ThirdCategory::where('id',$id)
        ->update([
            'name'=>$request->input('name'),
            'sub_category_id' => $request->input('sub_category'),
        ]);
        return redirect()->back()->with('message','third Category Updated Successfully');
    }

    public function thirdCategoryStatus($id,$status){
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

    public function thirdCategoryListWithSubCategory($sub_category_id){
        $third_category = ThirdCategory::where('sub_category_id',$sub_category_id)->where('status',1)->get();
        return $third_category;
    }

}
