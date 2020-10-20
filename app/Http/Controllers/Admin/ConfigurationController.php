<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\InvoiceSetting;
use File;
use Image;

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

    public function sizeListWithSubCategory($sub_category_id)
    {
        $size = Size::where('sub_category_id',$sub_category_id)->where('status',1)->get();
        return $size;
    }


    public function invoiceForm()
    {
        $invoice = InvoiceSetting::find(1);
        return view('admin.invoice.invoice',compact('invoice'));
    }

    public function invoiceUpdate(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'note1' => 'required',
            'note2' => 'required',
            'note3' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $invoice = InvoiceSetting::find(1);
        $invoice->address = $request->input('address');
        $invoice->phone = $request->input('phone');
        $invoice->gst = $request->input('gst');
        $invoice->email = $request->input('email');
        $invoice->note1 = $request->input('note1');
        $invoice->note2 = $request->input('note2');
        $invoice->note3 = $request->input('note3');

        if($request->hasfile('image'))
        {

        	$image = $request->file('image');
            $destination = base_path().'/public/images/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

            $prev_img_delete_path = base_path().'/public/images/'.$invoice->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            $invoice->image = $image_name;
        }

        $invoice->save();
        return redirect()->back()->with('message','invoice Data Updated Successfully');
    }
}
