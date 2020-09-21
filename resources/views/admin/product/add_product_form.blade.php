@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add New Product</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.product_insert' , 'enctype'=>'multipart/form-data']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Product name <span><b style="color: red"> * </b></span></label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Product name" required>
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Select Category <span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="">Select Category</option>
                                        @if(isset($category) && !empty($category))
                                            @foreach($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                     
                            </div>

                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="sub_category">Select Sub Category <span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="sub_category" id="sub_category" required>
                                      <option value="">Select First Category</option>
                                    </select>
                                    @if($errors->has('sub_category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="third_category">Select Third Category</label>
                                    <select class="form-control" name="third_category" id="third_category">
                                      <option value="">Select Third Category</option>
                                    </select>
                                    @if($errors->has('third_category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('third_category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="brand">Select Brand</label>
                                    <select class="form-control" name="brand" id="brand">
                                      <option value="">Select Brand</option>
                                    </select>
                                    @if($errors->has('brand'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @enderror      
                            </div>                            
                        </div>
                        <div class="well" style="overflow: auto" id="size_div">
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Select Size <span><b style="color: red"> * </b></span></label>
                                    <select class="form-control size_option" name="size[]"  required>
                                      <option value="">Select Size</option>
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
                                    <button type="button" class="btn btn-sm btn-info" onclick="add_more_inner_size_div()">Add More</button>
                                </div>
                            </div>
                        </div>

                        <div class="well" style="overflow: auto" >
                            <div class="form-row mb-3">     
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" style="margin-top: 20px;">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="color">Product Color ?</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <p > Yes : <input type="radio"  name="is_color" id="genderM" value="y" onclick="chkColor();" /> No : <input type="radio" name="is_color" id="genderF" value="n"  checked="" onclick="chkColor();" required/>
                                        </p>
                                    </div>
                                    
                                </div>              
                            </div>
                            <span id="color_div" style="display: none">
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="color">Select Color</label>
                                    <select class="form-control color_option" name="color[]" >
                                    <option value="">Select Color</option>
                                    </select>
                                    @if($errors->has('color'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @enderror
                                </div>   
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="colorDivAdd()">Add More</button>
                                </div>                      
                            </div>
                            </span>
                        </div>
                        <div class="well" style="overflow:auto">
                            <div class="well" style="overflow: auto" id="image_div">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size">Images <span><b style="color: red"> * </b></span></label>
                                        <input type="file" name="images[]" class="form-control" multiple required>
                                        @if($errors->has('images'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('images') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size_chart">Size Chart</label>
                                        <input type="file" name="size_chart" class="form-control">
                                        @if($errors->has('size_chart'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('size_chart') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="short_description">Type Short Product Descrition</label>
                                    <textarea class="form-control" name="short_description" id="short_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Long Product Descrition</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">    	            	
                        {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
    	            	</div>
    	            	{{ Form::close() }}

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

  @section('script')

  <script src="{{ asset('admin/ckeditor4/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'description', {
            height: 200,
        });

        var size_count = 1;
        function add_more_inner_size_div() {
            var size_option = $(".size_option").html();
            var htmlSize = `<div id="size_more_div${size_count}"><div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Select Size <span><b style="color: red"> * </b></span></label>
                                    <select class="form-control size_option" name="size[]"  required>
                                      ${size_option}
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
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSizeDiv(${size_count})">Remove</button>
                                </div>
                            </div></div>`;
            $("#size_div").append(htmlSize);
            size_count++;
        }

        function removeSizeDiv(id) {
            $("#size_more_div"+id).remove();
            size_count--;
        }

        var color_count = 1;
        function colorDivAdd() {
            var color_option = $(".color_option").html();
            var color_html = `<div id="color_more${color_count}"><div class="form-row mb-3">                               
                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                        <label for="color">Select Color</label>
                        <select class="form-control color_option" name="color[]" >
                        ${color_option}
                        </select>
                        @if($errors->has('color'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('color') }}</strong>
                            </span>
                        @enderror
                    </div>   
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                        <button type="button" class="btn btn-sm btn-danger" onclick="remove_color_div(${color_count})">Remove</button>
                    </div>                      
                </div></div>`;
            $("#color_div").append(color_html);
            color_count++;

        }

        function remove_color_div(id) {
            $("#color_more"+id).remove();
            color_count--;
        }

        function fetchSize(sub_category_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/size/list/with/category/')}}"+"/"+sub_category_id+"",
                success:function(data){
                    if ($.isEmptyObject(data)) {
                        $(".size_option").html("<option value=''>No Size Found</option>");
                    } else {
                        $(".size_option").html("<option value=''>Please Select Size</option>");
                        $.each( data, function( key, value ) {
                            $(".size_option").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });                          
                    }
                    

                }
            });
        }

        function fetchColor(sub_category_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/color/list/with/category/')}}"+"/"+sub_category_id+"",
                success:function(data){
                    if ($.isEmptyObject(data)) {
                        $(".color_option").html("<option value=''>No Color Found</option>");
                    } else {
                        $(".color_option").html("<option value=''>Please Select Color</option>");
                        $.each( data, function( key, value ) {
                            $(".color_option").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });                          
                    }
                    

                }
            });
        }

        function fetchBrand(sub_category_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/brands/list/with/category/')}}"+"/"+sub_category_id+"",
                success:function(data){
                    if ($.isEmptyObject(data)) {
                        $("#brand").html("<option value=''>No Brand Found</option>");
                    } else {
                        $("#brand").html("<option value=''>Please Select Brand</option>");
                        $.each( data, function( key, value ) {
                            $("#brand").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });                          
                    }
                    

                }
            });
        }

        function chkColor() {
            var is_color = $('input[name="is_color"]:checked').val();
            if (is_color == 'y') {
                $("#color_div").show();
            } else {
                $("#color_div").hide();
                
            }

        }

        $(document).ready(function(){
            $("#category").change(function(){
                var category = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/sub/category/list/with/category/')}}"+"/"+category+"",
                    success:function(data){
                        if ($.isEmptyObject(data)) {
                            $("#sub_category").html("<option value=''>No Sub Category Found</option>");
                        } else {
                            $("#sub_category").html("<option value=''>Please Select First Category</option>");
                            $.each( data, function( key, value ) {
                                $("#sub_category").append("<option value='"+value.id+"'>"+value.name+"</option>");
                            });                          
                        }
                        

                    }
                });
            });

            $("#sub_category").change(function(){
                var sub_category = $(this).val();
                fetchSize(sub_category);
                fetchColor(sub_category);
                fetchBrand(sub_category);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/third/category/list/with/category/')}}"+"/"+sub_category+"",
                    success:function(data){
                        console.log(data);
                       
                        if ($.isEmptyObject(data)) {
                            $("#third_category").html("<option value=''>No Third Category Found</option>"); 
                        } else {
                            $("#third_category").html("<option value=''>Please Select Third Category</option>"); 
                            $.each( data, function( key, value ) {
                                $("#third_category").append("<option value='"+value.id+"'>"+value.name+"</option>");
                            });                         
                        }
                        

                    }
                });
                
                
            });
        });



    </script>
 @endsection


        
    