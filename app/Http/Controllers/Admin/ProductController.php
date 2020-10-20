<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use \App\Models\Category;
use \App\Models\SubCategory;
use \App\Models\ThirdCategory;
use \App\Models\Brands;
use \App\Models\Size;
use \App\Models\Product;
use \App\Models\ProductImage;
use \App\Models\ProductSize;
use \App\Models\ProductColor;
use \App\Models\Color;
use DataTables;


class ProductController extends Controller
{
    public function AddProductForm()
    {
        $data = Category::where('status', 1)->get();
        return view('admin.product.add_product_form', ['category' => $data]);
    }

    public function ListProducts()
    {
        return view('admin.product.list_all_products');
    }

    public function productListAjax(Request $request)
    {
        return datatables()->of(Product::get())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('admin.product_view', ['id' => $row->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>
                <a href="' . route('admin.product_edit', ['id' => $row->id]) . '" class="btn btn-warning btn-sm" target="_blank">Edit</a>
                <a href="' . route('admin.product_edit_sizes', ['product_id' => $row->id]) . '" class="btn btn-warning btn-sm" target="_blank">Edit Sizes</a>
                <a href="' . route('admin.product_edit_colors', ['id' => $row->id]) . '" class="btn btn-warning btn-sm" target="_blank">Edit Colors</a>';

                $btn .=  '<a href="' . route('admin.product_edit_images', ['product_id' => $row->id]) . '" class="btn btn-warning btn-sm" target="_blank">Edit Images</a>';
                if($row->is_popular==1){
                    $btn .=  '<a href="' . route('admin.make_product_popular', ['product_id' => $row->id]) . '" class="btn btn-info btn-sm">Make Product Popular</a>';
                }

                if ($row->status == '1') {
                    $btn .= '<a href="' . route('admin.product_status_update', ['id' => $row->id, 'status' => 2]) . '" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .= '<a href="' . route('admin.product_status_update', ['id' => $row->id, 'status' => 1]) . '" class="btn btn-primary btn-sm" >Enable</a>';
                }
                return $btn;
            })->addColumn('category', function ($row) {
                if (isset($row->category->name)) {
                    return $row->category->name;
                } else {
                    return null;
                }
            })->addColumn('sub_category', function ($row) {
                if (isset($row->subCategory->name)) {
                    return $row->subCategory->name;
                } else {
                    return null;
                }
            })->addColumn('third_category', function ($row) {
                if (isset($row->thirdCategory->name)) {
                    return $row->thirdCategory->name;
                } else {
                    return null;
                }
            })->addColumn('status_tab', function ($row) {
                if ($row->status == 1) {
                    return '<a class="btn btn-primary btn-sm" target="_blank">Enabled</a>';
                } else {
                    return '<a class="btn btn-danger btn-sm" target="_blank">Disabled</a>';
                }
            })
            ->rawColumns(['action', 'category', 'status_tab'])
            ->make(true);
    }

    public function insertProduct(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        $size = $request->input('size'); // array
        $stock = $request->input('stock'); // array of stock
        $mrp = $request->input('mrp'); // array of mrp
        $price = $request->input('price'); // array of price


        $is_color = $request->input('is_color'); // y = yes, n = no
        $color = $request->input('color'); // array of color
        $short_description = $request->input('short_description');
        $description = $request->input('description');

        $product = new Product();
        $product->name = $name;
        $product->category_id = $category;
        $product->sub_category_id = $sub_category;
        $product->last_category_id = $third_category;
        $product->short_description = $short_description;
        $product->description = $description;
        if (isset($brand)) {
            $product->brand_id = $brand;
        }
        if ($request->hasFile('size_chart')) {
            $path = public_path() . '/images/products/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path() . '/images/products/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);
            $image = $request->file('size_chart');
            $image_name = time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path() . '/images/products';
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath . '/' . $image_name);
            //Product Thumbnail
            $destination = public_path() . '/images/products/thumb';
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination . '/' . $image_name);
            $product->size_chart = $image_name;
        }
        if ($product->save()) {

            /** Images Upload **/
            $path = public_path() . '/images/products/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path() . '/images/products/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);
            $banner = null;

            if ($request->hasFile('images')) {
                for ($i = 0; $i < count($request->file('images')); $i++) {
                    $image = $request->file('images')[$i];
                    $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();
                    if ($i == 0) {
                        $banner = $image_name;
                    }
                    //Product Original Image
                    $destinationPath = public_path() . '/images/products';
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath . '/' . $image_name);
                    //Product Thumbnail
                    $destination = public_path() . '/images/products/thumb';
                    $img = Image::make($image->getRealPath());
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination . '/' . $image_name);

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


            if (isset($size) && !empty($size)) {
                $length = count($size);
                for ($i = 0; $i < $length; $i++) {
                    $size_data = isset($size[$i]) ? $size[$i] : 1;
                    $stock_data = isset($stock[$i]) ? $stock[$i] : 0;
                    $mrp_data = isset($mrp[$i]) ? $mrp[$i] : 0;
                    $price_data = isset($price[$i]) ? $price[$i] : 0;


                    if (($min_price > $price_data) || ($min_price == 0)) {
                        $min_price = $price_data;
                        $min_mrp = $mrp_data;
                    }
                    $product_size = new ProductSize();
                    $product_size->size_id = $size_data;
                    $product_size->product_id = $product->id;
                    $product_size->mrp = $mrp_data;
                    $product_size->price = $price_data;
                    $product_size->stock = $stock_data;
                    $product_size->save();
                }
            }
            $product->min_price = $min_price;
            $product->mrp = $min_mrp;
            $product->save();

            if (isset($color) && !empty($color)) {
                for ($i = 0; $i < count($color); $i++) {
                    if (!empty($color[$i])) {
                        $colors = new ProductColor();
                        $colors->color_id = $color[$i];
                        $colors->product_id = $product->id;
                        $colors->save();
                    }
                }
            }
            return redirect()->back()->with('message', 'Product Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }

    public function productView($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.product.product_details', compact('product'));
    }

    public function productEdit($product_id)
    {
        $product = Product::find($product_id);
        $category = Category::where('status', 1)->get();
        $sub_category = null;
        $third_category = null;
        $brand = null;
        if (!empty($product->category_id)) {
            $sub_category = SubCategory::where('category_id', $product->category_id)->where('status', 1)->get();
        }
        if (!empty($product->sub_category_id)) {
            $third_category = ThirdCategory::where('sub_category_id', $product->sub_category_id)->where('status', 1)->get();
        }
        if (!empty($product->brand_id)) {
            $brand = Brands::where('sub_category_id', $product->sub_category_id)->where('status', 1)->get();
        }


        return view('admin.product.edit_product', compact('product', 'category', 'sub_category', 'third_category', 'brand', 'product_id'));
    }

    public function productUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'name'   => 'required',
            'category'   => 'required',
            'sub_category'   => 'required',
            'size_chart' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Product::where('id', $id)->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
            'last_category_id' => $request->input('third_category'),
            'brand_id' => $request->input('brand'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description')
        ]);


        $size_chart_id = Product::where('id', $id)->first();
        if ($request->hasFile('size_chart')) {
            $path = public_path() . '/images/products/';
            File::exists($path) or File::makeDirectory($path, 0777, true, true);
            $path_thumb = public_path() . '/images/products/thumb/';
            File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);
            $image = $request->file('size_chart');
            $image_name = time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path() . '/images/products';
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath . '/' . $image_name);
            $prev_img_delete_path = public_path() . '/images/products/' . $size_chart_id->size_chart;
            if (File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }
            $prev_img_delete_path_thumb = public_path() . '/images/products/thumb/' . $size_chart_id->size_chart;
            $destination = public_path() . '/images/products/thumb';
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination . '/' . $image_name);
            if (File::exists($prev_img_delete_path_thumb)) {
                File::delete($prev_img_delete_path_thumb);
            }
            Product::where('id', $id)->update([
                'size_chart' => $image_name
            ]);
        }
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function productEditColors($id)
    {
        $product = Product::where('id', $id)->first();
        $product_colors = ProductColor::where('product_id', $id)->get();
        $colors = null;
        if (!empty($product) && !empty($product->sub_category_id)) {
            $colors = Color::where('sub_category_id', $product->sub_category_id)->get();
        }

        return view('admin.product.edit_product_color', compact('product', 'colors', 'product_colors'));
    }

    public function addNewColor(Request $request, $product_id)
    {
        $this->validate($request, [
            'color'   => 'required|array',
        ]);
        $color = $request->input('color');
        if (isset($color) && !empty($color)) {
            for ($i = 0; $i < count($color); $i++) {
                if (!empty($color[$i])) {
                    $check = ProductColor::where('color_id', $color[$i])->where('product_id', $product_id)->count();
                    if ($check == 0) {
                        $colors = new ProductColor();
                        $colors->color_id = $color[$i];
                        $colors->product_id = $product_id;
                        $colors->save();
                    }
                }
            }
        }
        return redirect()->route('admin.product_edit_colors', ['id' => $product_id]);
    }

    public function productDeleteColor($id)
    {
        ProductColor::where('id', $id)->delete('color_id');
        return redirect()->back();
    }

    public function updateColor($product_id, Request $request)
    {
        $this->validate($request, [
            'colors'   => 'required|array',
            'color_id'   => 'required|array',
        ]);
        $colors = $request->input('colors');
        $color_id = $request->input('color_id');

        for ($i = 0; $i < count($color_id); $i++) {
            if (isset($color_id[$i]) && !empty($color_id[$i]) && isset($colors[$i]) && !empty($colors[$i])) {
                $check_color = ProductColor::where('color_id', $colors[$i])->where('product_id', $product_id)->count();
                if ($check_color == 0) {
                    $product_color = ProductColor::find($color_id[$i]);
                    $product_color->color_id = $colors[$i];
                    $product_color->save();
                }
            }
        }
        return redirect()->back()->with("message", "Color Updated Sucessfully");
    }

    public function productStatusUpdate($id, $status)
    {
        $category = Product::where('id', $id)
            ->update([
                'status' => $status,
            ]);
        return redirect()->back();
    }

    public function editImages($product_id)
    {
        $product_images = ProductImage::where('product_id', $product_id)->get();
        $product = Product::find($product_id);
        return view('admin.product.images', compact('product_images', 'product'));
    }

    public function makeCoverImage($product_id, $image_id)
    {
        $image = ProductImage::find($image_id);
        if ($image) {
            Product::where('id', $product_id)->update([
                'main_image' => $image->image,
            ]);
        }
        return redirect()->back();
    }

    public function deleteImage($image_id)
    {
        $image = ProductImage::where('id', $image_id)->first();
        if ($image) {
            $path = public_path() . '/images/products/' . $image->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $path_thumb = public_path() . '/images/products/thumb/' . $image->image;
            if (File::exists($path_thumb)) {
                File::delete($path_thumb);
            }
        }
        ProductImage::where('id', $image_id)->delete();
        return redirect()->back();
    }

    public function addNewImages(Request $request)
    {
        $path = public_path() . '/images/products/';
        File::exists($path) or File::makeDirectory($path, 0777, true, true);
        $path_thumb = public_path() . '/images/products/thumb/';
        File::exists($path_thumb) or File::makeDirectory($path_thumb, 0777, true, true);

        $product_id = $request->input('product_id');

        if ($request->hasFile('image')) {
            for ($i = 0; $i < count($request->file('image')); $i++) {
                $image = $request->file('image')[$i];
                $image_name = $i . time() . date('Y-M-d') . '.' . $image->getClientOriginalExtension();

                //Product Original Image
                $destinationPath = public_path() . '/images/products';
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $image_name);

                //Product Thumbnail
                $destination = public_path() . '/images/products/thumb';
                $img = Image::make($image->getRealPath());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination . '/' . $image_name);

                ProductImage::create([
                    'image' => $image_name,
                    'product_id' => $product_id,
                ]);
            }
        }
        return redirect()->back();
    }

    public function editSizes($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        $sizes = null;
        if ($product) {
            $sizes = Size::where('sub_category_id', $product->sub_category_id)->where('status', 1)->get();
        }
        // dd($product->sizes);
        return view('admin.product.edit_size', compact('product', 'sizes'));
    }

    public function updateSize(Request $request, $product_id)
    {
        $this->validate($request, [
            'size_id'   => 'required|array',
            'size'   => 'required|array',
            'stock'   => 'required|array',
            'mrp'   => 'required|array',
            'price'   => 'required|array',
        ]);
        $size = $request->input('size');
        $size_id = $request->input('size_id');
        $stock = $request->input('stock');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        if (isset($size_id) && !empty($size_id) && (count($size_id) > 0)) {
            for ($i = 0; $i < count($size_id); $i++) {

                $check = ProductSize::where('size_id', $size[$i])->where('product_id', $product_id)->where('id','!=',$size_id[$i])->count();
                if ($check == 0) {
                    $product_size = ProductSize::find($size_id[$i]);
                    $product_size->size_id = $size[$i];
                    $product_size->mrp = $mrp[$i];
                    $product_size->price = $price[$i];
                    $product_size->stock = $stock[$i];
                    $product_size->save();
                }
            }
        }
        return redirect()->back();
    }

    public function addNewSize(Request $request,$product_id)
    {
        $this->validate($request, [
            'size'   => 'required|array',
            'stock'   => 'required|array',
            'mrp'   => 'required|array',
            'price'   => 'required|array',
        ]);
        $size = $request->input('size');
        $stock = $request->input('stock');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        if (isset($size) && !empty($size) && (count($size) > 0)) {
            for ($i = 0; $i < count($size); $i++) {

                $check = ProductSize::where('size_id', $size[$i])->where('product_id', $product_id)->count();
                if ($check == 0) {
                    $product_size = new ProductSize();
                    $product_size->size_id = $size[$i];
                    $product_size->mrp = $mrp[$i];
                    $product_size->price = $price[$i];
                    $product_size->stock = $stock[$i];
                    $product_size->product_id = $product_id;
                    $product_size->save();
                }
            }
        }
        return redirect()->back();
    }

    public function makeProductPopular($product_id){
        $product = Product::find($product_id);
        if($product->is_popular == 1){
            $product->is_popular = 2;
            $product->save();
        }
        else{
            $product->is_popular = 1;
            $product->save();
        }
        return redirect()->back();
    }

    public function popularList(){
        $product_list = Product::where('is_popular',2)->get();
        return view('admin.product.popular_products_list',compact('product_list'));
    }
}
