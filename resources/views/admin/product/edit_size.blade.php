@extends('admin.template.admin_master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit Product Size</h2>
    	            <div class="clearfix"></div>
    	        </div>
                <div>
                     @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
                     @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                     @endif

                </div>
    	        <div>
    	            <div class="x_content">
                        @if (isset($product))
                            <div id="product_size_add_form">
                                {{ Form::open(['method' => 'post','route'=>'admin.product_add_new_sizes']) }}
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="well" style="overflow: auto" id="size_div">
                                        <div class="form-row mb-3">                                
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="size">Select Size <span><b style="color: red"> * </b></span></label>
                                                <select class="form-control size_option" name="size[]"  required>
                                                  <option value="">Select Size</option>
                                                    @if (isset($sizes) && !empty($sizes))
                                                        @foreach ($sizes as $size)
                                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="stock">Enter Stock <span><b style="color: red"> * </b></span></label>
                                                <input type="number" step="any" class="form-control" name="stock[]"  placeholder="Enter Stock" min="1" value="1" required>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="mrp">Enter M.R.P. <span><b style="color: red"> * </b></span></label>
                                                <input type="number" step="any" class="form-control" name="mrp[]"  placeholder="Enter MRP" required>
                                            </div>
            
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="price">Enter Price <span><b style="color: red"> * </b></span></label>
                                                <input type="number" step="any" class="form-control" name="price[]"  placeholder="Enter Price" required>
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                                <button type="button" class="btn btn-sm btn-info" id="add_more_size">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <button type="submit" class='btn btn-success'>Submit</button>
                                        <button type="button" class='btn btn-warning' id="size_add_form_back_btn">Back</button>
                                    </div>
                                {{ Form::close() }}
                            </div>

                            <div id="product_size_edit_form">

                                @if (isset($product->sizes))
                                    <div class="col-md-12">
                                        {{ Form::open(['method' => 'put','route'=>['admin.product_update_sizes','product_id'=>$product->id]]) }}
                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th>Size</th>
                                            <th><b>Stock</b></th>
                                            <th><b>MRP</b></th>
                                            <th><b>Price</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->sizes as $item)
                                                <tr>
                                                    <td>
                                                        <select class="form-control size_option" name="size[]"  required>
                                                            <option value="">Select Size</option>
                                                            @if (isset($sizes) && !empty($sizes))
                                                                @foreach ($sizes as $size)
                                                                    @if ($item->size_id == $size->id)
                                                                    <option value="{{$size->id}}" selected>{{$size->name}}</option>
                                                                    @else
                                                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                                                    @endif                                                                    
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td> 
                                                        <input type="number" class="form-control" name="stock[]"  placeholder="Enter Product Stock" value="{{$item->stock}}"  required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="mrp[]"  placeholder="Enter MRP" value="{{$item->mrp}}"  required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="price[]"  placeholder="Enter price" value="{{$item->price}}">
                                                    </td>
                                                </tr>
                                            @endforeach      
                                            <tr>
                                                <td colspan="8" align="center">
                                                    <button type="button" class="btn btn-sm btn-primary" id="add_more_size_btn">Add New Size</button>
                                                    <button type="submit" class='btn btn-success'>Update Size</button>
                                                    <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                                                </td>
                                            </tr>                      
                                        </tbody>
                                        </table>
                                        {{ Form::close() }}
                                    </div>                    
                                @endif
                                
                            </div>  
                        @endif
    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
<script>
    var size_div_count = 1;
    $(function() {  
        $("#product_size_add_form").hide();
        $(document).on('click',"#add_more_size", function(){
            var size_html = `<br><div class="form-row mb-3">
                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="size">Enter Size Name</label>
                    <input type="text" class="form-control" name="size[]"  placeholder="Enter Size Name" required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="mrp">Enter Product M.R.P.</label>
                    <input type="number" class="form-control" name="mrp[]"  placeholder="Enter Product M.R.P." required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="customer_price">Enter Customer Price.</label>
                    <input type="number" class="form-control" name="customer_price[]"  placeholder="Enter Customer Price" required>
                </div>

            </div>
            
            <div class="form-row mb-3">
                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="retailer_price">Enter Retailer Price.</label>
                    <input type="number" class="form-control" name="retailer_price[]"  placeholder="Enter Retailer Price" required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="customer_discount">Enter Customer Discount.</label>
                    <input type="number" class="form-control" name="customer_discount[]"  placeholder="Enter Customer Discount" >
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="retailer_discount">Enter Retailer Discount.</label>
                    <input type="number" class="form-control" name="retailer_discount[]"  placeholder="Enter Retailer Discount" >
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                <label for="min_order_quantity">Retailer Min Order Quantity</label>
                <input type="number" class="form-control" name="min_order_quantity[]"  placeholder="Enter Retailer Min Order Quantity"  required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" name="stock[]"  placeholder="Enter Product Stock"  required>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 26px;" onclick="removeSize(${size_div_count})">Remove</button>
                </div>
            </div>`;
            $("#size_div").append("<span id='sizes"+size_div_count+"'>"+size_html+"</span>");
            size_div_count++;
        });

        $(document).on('click',"#add_more_size_btn",function(){
            $("#product_size_add_form").show();
            $("#product_size_edit_form").hide();
        });

        $(document).on('click',"#size_add_form_back_btn",function(){
            $("#product_size_add_form").hide();
            $("#product_size_edit_form").show();
        });
    });



    function removeSize(id) {
        $("#sizes"+id).remove();
        size_div_count--;
    }


</script>
 @endsection


        
    