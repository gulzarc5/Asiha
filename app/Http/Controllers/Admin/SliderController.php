<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Image;
use App\Models\Slider;
use App\Models\Category;
class SliderController extends Controller
{
    public function appSliderList(){
        $slider = Slider::orderBy('id','desc')->where('variant_type',1)->get();
        return view('admin.slider.app.app_slider_list',compact('slider'));
    }
    public function webSliderList(){
        $slider = Slider::orderBy('id','desc')->where('variant_type',2)->get();
        return view('admin.slider.web.web_slider_list',compact('slider'));
    }

    public function appSliderAddForm(){
        $category = Category::get();
        return view('admin.slider.app.new_app_slider_form',compact('category'));
    }

    public function webSliderAddForm(){
        $category = Category::get();
        return view('admin.slider.web.new_web_slider_form',compact('category'));
    }

    public function insertWebSlider(Request $request){
        $this->validate($request, [
            'third_category'=>'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_name = null;
        if($request->hasfile('images')){
            $path = public_path().'/images/slider/web/thumb/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path().'/images/slider/web/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

            for ($i=0; $i < count($request->file('images')); $i++) {
                $image = $request->file('images')[$i];
                $image_name = $i.time().date('Y-M-d').'.'.$image->getClientOriginalExtension();

                //Product Original Image
                $destination = public_path().'/images/slider/web/';
                $img = Image::make($image->getRealPath());
                $img->save($destination.'/'.$image_name);

                //Product Thumbnail
                $destination = public_path().'/images/slider/web/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$image_name);

                $sliders = new Slider;
                $sliders->third_category_id = $request->input('third_category');
                $sliders->variant_type=2;
                $sliders->slider_type=2;
                $sliders->image=$image_name;
                $sliders->save();

            }
        }
        return redirect()->back()->with('message','Slider Added Successfull');
    }
    public function insertAppSlider(Request $request){
        $this->validate($request, [
            'third_category'=>'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_name = null;

        if($request->hasfile('images')){
            $path = public_path().'/images/slider/app/thumb/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path().'/images/slider/app/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

            for ($i=0; $i < count($request->file('images')); $i++) {
                $image = $request->file('images')[$i];
                $image_name = $i.time().date('Y-M-d').'.'.$image->getClientOriginalExtension();

                //Product Original Image
                $destination = public_path().'/images/slider/app/';
                $img = Image::make($image->getRealPath());
                $img->save($destination.'/'.$image_name);

                //Product Thumbnail
                $destination = public_path().'/images/slider/app/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$image_name);

                $sliders = new Slider;
                $sliders->variant_type=1;
                $sliders->slider_type=2;
                $sliders->image=$image_name;
                $sliders->save();

            }
        }

        return redirect()->back()->with('message','Slider Added Successfull');
    }


    public function SliderStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = Slider::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }

    public function SliderDelete(Request $request,$id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

            $prev_image = Slider::where('id',$id)->first();
            if($prev_image->variant_type==1){
            $prev_img_delete_path = public_path().'/images/slider/app/'.$prev_image->image;
            $prev_img_delete_path_thumb = public_path().'/images/slider/app/thumb/'.$prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }
        }
        else{
            $prev_img_delete_path = public_path().'/images/slider/web/'.$prev_image->image;
            $prev_img_delete_path_thumb = public_path().'/images/slider/web/thumb/'.$prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }

        }
            Slider::where('id',$id)
            ->delete();
            return redirect()->back();

    }



    public function bannerEdit($banner_id){
        try {
            $id = decrypt($banner_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $banner = Slider::where('id',$id)->first();

        return view('admin.slider.app.banner_edit_form',compact('banner'));
    }

    public function bannerUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = null;
        if($request->hasfile('images'))
        {
            $prev_image = Slider::where('id',$id)->first();

            $path = public_path().'/images/slider/banner/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path().'/images/slider/banner/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        	$image = $request->file('images');
            $destination = public_path().'/images/slider/banner/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);


            $thumb_path = public_path().'/images/slider/banner/thumb/'.$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(null,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);

            $prev_img_delete_path = public_path().'/images/brands/'.$prev_image->image;
            $prev_img_delete_path_thumb = public_path().'/images/brands/thumb/'.$prev_image->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            if ( File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }
            Slider::where('id',$id)
            ->update([
                'image'=>$image_name,
            ]);
            return redirect()->back()->with('message','Banner Updated Successfully');
        }
    }


}
