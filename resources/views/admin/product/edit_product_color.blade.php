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
    	            <h2>Edit Product Color</h2>
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
                        @if (isset($product) && !empty($product))
                            @php
                                $color = $product->productColors; 
                            @endphp
                            @if(isset($color) && !empty($color) && count($color) > 0)
                                <div id="product_size_add_form">
                                    {{ Form::open(['method' => 'post','route'=>'admin.product_add_new_sizes']) }}
                                        <input type="hidden" name="product_id" value="">
                                        <div class="well" style="overflow: auto" id="size_div">
                                            <div class="form-row mb-3">                                
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <label for="color">Select Color <span><b style="color: red"> * </b></span></label>
                                                    <select class="form-control size_option" name="color[]"  required>
                                                    <option value="">Select Color</option>
                                                        @if (isset($colors) && !empty($colors))
                                                            @foreach ($colors as $color)
                                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <label for="stock">Color Code <span><b style="color: red"> * </b></span></label>
                                                    <input type="number" step="any" class="form-control" name="stock[]"  placeholder="Enter Stock" min="1" value="1" required>
                                                </div>
                                                
                                                <div class="col-md-8 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                                    <button type="button" class="btn btn-sm btn-info" id="add_more_size" >Add More</button>
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
                                    <div class="col-md-12">
                                        {{ Form::open(['method' => 'put','route'=>['admin.product_update_color','product_id'=>$product->id]]) }}
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th><b>Color Code</b></th>
                                                    <th>Action</th>                                            
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($color as $item)
                                                    <tr>
                                                        <td>{{dd($color->name)}}</td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($color as $data)
                                                    <tr>
                                                        <td> 
                                                            {{dd($color)}}
                                                            <input type="hidden" name="color_id[]" value="{{$value->id}}">
                                                            <select class="form-control size_option" name="colors[]" id="colors{{$value->id}}" required onchange="chkColor({{$value->id}})">
                                                                <option value=""  >Select Color</option>
                                                                @if (isset($colors) && !empty($colors))
                                                                    @foreach ($colors as $item)  
                                                                        @if ($item->id == $value->color_id)
                                                                            <option value="{{$item->id}}" data-colorid="{{$item->color}}" selected>{{$item->name}}</option>
                                                                        @else
                                                                            <option value="{{$item->id}}" data-colorid="{{$item->color}}">{{$item->name}}</option>
                                                                        @endif 
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                            @if($errors->has('colors'))
                                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                                    <strong>{{ $errors->first('colors') }}</strong>
                                                                </span> 
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <div id="code{{$value->id}}" style="background-color:{{$value->color->color}}; height:10px;"></div>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.delete_product_color',['product_color_id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach   
                                                <tr>
                                                    <td colspan="8" align="center">
                                                        <button type="button" class="btn btn-sm btn-primary" id="add_more_size_btn">Add New Color</button>
                                                        <button type="submit" class='btn btn-success'>Update Color</button>
                                                        <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                                                    </td>
                                                </tr>                  
                                            </tbody>
                                        </table>
                                        {{ Form::close() }}
                                    </div>
                                </div>  
                            @else
                                <div>
                                    {{ Form::open(['method' => 'post','route'=>'admin.product_add_new_sizes']) }}
                                        <input type="hidden" name="product_id" value="">
                                        <div class="well" style="overflow: auto" id="size_div">
                                            <div class="form-row mb-3">                                
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <label for="color">Select Color <span><b style="color: red"> * </b></span></label>
                                                    <select class="form-control size_option" name="color[]"  required>
                                                    <option value="">Select Color</option>
                                                        @if (isset($colors) && !empty($colors))
                                                            @foreach ($colors as $color)
                                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <label for="stock">Color Code <span><b style="color: red"> * </b></span></label>
                                                    <input type="number" step="any" class="form-control" name="stock[]"  placeholder="Enter Stock" min="1" value="1" required>
                                                </div>
                                                
                                                <div class="col-md-8 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                                    <button type="button" class="btn btn-sm btn-info" id="add_more_size" >Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">    
                                            <button type="submit" class='btn btn-success'>Submit</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            @endif
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
                    <label for="retailer_price">Select Color</label>
                    <select class="form-control size_option" name="colors[]"  required>
                        <option value=""  >Select Color</option>
                    </select>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                    <label for="mrp">Enter Product M.R.P.</label>
                    <input type="number" class="form-control" name="mrp[]"  placeholder="Enter Product M.R.P." required>
                </div>

                

            </div>
            
            

            <div class="form-row mb-3">
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

    function chkColor(id) {
        var data = $("#colors"+id).find(':selected').attr('data-colorid');
        $('#code'+id).html('<div id="code" style="background-color:'+data+'; height:10px;"></div>');
    }


</script>
 @endsection


        
    