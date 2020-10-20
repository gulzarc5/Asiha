@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Product Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($product) && !empty($product))
                    <div class="col-md-6 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$product->name}} <a href="#" class="btn btn-warning" style="float:right;margin-top: -8px;">Edit Product</a></h3>
                        <p>{{$product->p_short_desc}}</p>
                        <div class="row product-view-tag">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Name:</strong>
                                    {{$product->name}}
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Catagory:</strong>
                                @if (isset($product->category->name))
                                    {{$product->category->name}}
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Sub Category:</strong>
                                @if (isset($product->subCategory->name))
                                    {{$product->subCategory->name}}
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Third Category:</strong>
                                @if (isset($product->thirdCategory->name))
                                    {{$product->thirdCategory->name}}
                                @endif
                            </h5>

                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Brand:</strong>
                                @if (isset($product->brand->name))
                                    {{$product->brand->name}}
                                @endif
                            </h5>

                            <h5 class="col-md-4 col-sm-4 col-xs-12"><strong>Status :</strong>
                                @if ($product->status == '1')
                                    <button class="btn btn-sm btn-primary">Enabled</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                @endif
                            </h5>
                        </div>
                        <br/>

                    </div>
                    @if (isset($product->images))
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h3 class="prod_title">Images <a href="#" class="btn btn-warning" style="float:right;margin-top: -8px;"><i class="fa fa-edit"></i></a></h3>
                            <div class="product-image">
                                <img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt="..." style="height: 200px;width: 300px;"/>
                            </div>
                            <div class="product_gallery">
                                @foreach ($product->images as $item)
                                    @if ($product->main_image != $item->image)
                                    <a>
                                        <img src="{{asset('images/products/thumb/'.$item->image.'')}}" alt="..." />
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (isset($product->sizes))
                        <div class="col-md-12">
                            <hr>
                            <h3>Product Size List <a class="btn btn-warning" style="float:right" href="">Edit Sizes</a></h3>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th><b>M.R.P</b></th>
                                    <th><b>Price</b></th>
                                    <th><b>Stock</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->sizes as $item)
                                    <tr>
                                        <td>{{$item->size->name}}</td>
                                        <td>{{$item->mrp}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->stock}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif

                    @if (isset($product->productColors))
                        <div class="col-md-12">
                            <hr>
                            <h3>Product Colors <a class="btn btn-warning" style="float:right" href="">Edit colors</a></h3>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><b>Name</b></th>
                                    <th><b>Color</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->productColors as $item)
                                    <tr>
                                        <td>{{$item->color->name}}</td>
                                        <td><div style="background-color:{{$item->color->color}}; height:10px;"></div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif
                    @if (!empty($product->size_chart))
                    <div class="col-md-12">
                        <div class="product_price">
                            <h3 style="margin: 0">Size Chart</h3><hr style="margin: 10px 0;border-top: 1px solid #ddd;">
                            <img src="{{asset('images/products/'.$product->size_chart.'')}}" alt="..." style="height: 400px;"/>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <div class="product_price">
                            <h3 style="margin: 0">Product Short Description</h3><hr style="margin: 10px 0;border-top: 1px solid #ddd;">
                                <p>{!!$product->short_description!!}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="product_price">
                            <h3 style="margin: 0">Product Description</h3><hr style="margin: 10px 0;border-top: 1px solid #ddd;">
                                <p>{!!$product->description!!}</p>
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection
