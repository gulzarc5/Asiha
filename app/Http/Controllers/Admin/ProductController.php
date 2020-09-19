<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use\App\Models\Category;
use\App\Models\Product;

class ProductController extends Controller
{
    public function AddProductForm(){
        $data =Category::where('status',1)->get();
        return view('admin.product.add_product_form',['category'=>$data]);
    }

    public function ListProducts(){
        return view('admin.product.list_all_products');
    }

    public function insertProduct(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size_chart' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size.*' => 'required',
            'stock.*' => 'required',
            'mrp.*' => 'required',
            'price.*' => 'required',
        ]);
        $name = $request->input('name');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $third_category = $request->input('third_category');
        $brand = $request->input('brand');

        $size = $request->input('size');// array
        $stock = $request->input('stock'); // array of stock
        $mrp = $request->input('mrp'); // array of mrp
        $price = $request->input('price'); // array of price

        $is_color = $request->input('is_color'); // y = yes, n = no
        $color = $request->input('color'); // array of color
        $images = $request->input('images'); // array of images
        $size_chart = $request->input('size_chart'); 
        $short_description = $request->input('short_description');
        $description = $request->input('description');

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category');
        $product->sub_category_id = $request->input('sub_category');
        $product->product_type = $category->category_type;
        $product->description = $request->input('description');

        if ($product->save()) {
             /** Images Upload **/
            $path = base_path().'/public/images/products/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = base_path().'/public/images/products/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);
            $banner = null;

            if ($request->hasFile('image')) {              
                for ($i=0; $i < count($request->file('image')); $i++) {                     
                    $image = $request->file('image')[$i];  
                    $image_name = $i.time().date('Y-M-d').'.'.$image->getClientOriginalExtension();
                    if ($i == 0){
                        $banner = $image_name;
                    }
                    //Product Original Image
                    $destinationPath =base_path().'/public/images/products';
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath.'/'.$image_name);
                    //Product Thumbnail
                    $destination = base_path().'/public/images/products/thumb';
                    $img = Image::make($image->getRealPath());
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination.'/'.$image_name);

                    $product_image = new ProductImage();
                    $product_image->image = $image_name;
                    $product_image->product_id = $product->id;
                    $product_image->save();
                }
               $product->main_image = $banner;
               $product->save();
            }

            $min_price = 0;
            $min_mrp = 0;
        

            if (isset($weight) && !empty($weight)) {
                $length = count($weight);
                for ($i=0; $i < $length; $i++) { 
                    $weight_type_data = isset($weight_type[$i]) ? $weight_type[$i] : 1;
                    $weight_data = isset($weight[$i]) ? $weight[$i] : 0;
                    $mrp_data = isset($mrp[$i]) ? $mrp[$i] : 0;
                    $price_data = isset($price[$i]) ? $price[$i] : 0;
                    $stock_data = isset($stock[$i]) ? $stock[$i] : 0;
                    $min_ord_qtty_data = isset($min_ord_qtty[$i]) ? $min_ord_qtty[$i] : 0;

                   
                    if (($min_price > $price) || ($min_price == 0)) {
                        $min_price = $price_data;
                        $min_mrp = $mrp_data;
                    }                    
                    $product_size = new ProductSize();
                    $product_size->size_type_id = $weight_type_data;
                    $product_size->product_id = $product->id;
                    $product_size->size = $weight_data;
                    $product_size->mrp = $mrp_data;
                    $product_size->price = $price_data;
                    $product_size->min_ord_quantity = $min_ord_qtty_data;
                    $product_size->stock = $stock_data;
                    $product_size->save();
                }
            }
            $product->min_price = $min_price;
            $product->mrp = $min_mrp;
            $product->save();
            
            return redirect()->back()->with('message','Product Added Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
}
