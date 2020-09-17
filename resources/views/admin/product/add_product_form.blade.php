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
    	           
    	            	{{-- {{ Form::open(['method' => 'post','route'=>'admin.product_insert' , 'enctype'=>'multipart/form-data']) }} --}}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Product name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Product name" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Select Category</label>
                                    <select class="form-control" name="category" id="category">
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
                                    <label for="sub_category">Select Sub Category</label>
                                    <select class="form-control" name="sub_category" id="sub_category">
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
                                <label for="brand">Brand name</label>
                                <input type="text" class="form-control" name="brand"  placeholder="Enter Product name" >
                                  @if($errors->has('brand'))
                                      <span class="invalid-feedback" role="alert" style="color:red">
                                          <strong>{{ $errors->first('brand') }}</strong>
                                      </span>
                                  @enderror
                            </div>
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="color">Select Color</label>
                                    <select class="form-control" name="color" id="color">
                                      <option value="">Select Color</option>
                                    </select>
                                    @if($errors->has('color'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                            
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Select Size</label>
                                    <select class="form-control" name="size" id="size">
                                      <option value="">Select Size</option>
                                    </select>
                                    @if($errors->has('size'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('size') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                <label for="stock">Enter Stock</label>
                                <input type="number" step="any" class="form-control" name="stock[]"  placeholder="Enter Stock" min="1" value="1" required>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                <label for="mrp">Enter M.R.P.</label>
                                <input type="number" step="any" class="form-control" name="mrp[]"  placeholder="Enter MRP" required>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                <label for="price">Enter Price</label>
                                <input type="number" step="any" class="form-control" name="price[]"  placeholder="Enter Price" required>
                            </div>
                        </div>
                        <div class="well" style="overflow:auto">
                            <div class="well" style="overflow: auto" id="image_div">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size">Images</label>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>
                                </div>
                                @if($errors->has('images'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('images') }}</strong>
                                    </span>
                                @enderror
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size_chart">Size Chart</label>
                                        <input type="file" name="size_chart[]" class="form-control" multiple>
                                    </div>
                                </div>
                                @if($errors->has('size_chart'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('size_chart') }}</strong>
                                    </span>
                                @enderror
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
            var size_option = $("#size_option").html();
            var htmlSize = `<div id="size_more_div${size_count}"><div class="form-row mb-10" >
                            <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                <label for="weight_type">Weight Type</label>
                                <select class="form-control size" name="weight_type[]" id="size_option" required>
                                    ${size_option}
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                <label for="weight">Weight</label>
                                <input type="number" step="any" class="form-control" name="weight[]"  placeholder="Enter Weight" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="mrp">Enter M.R.P.</label>
                            <input type="number" step="any" class="form-control" name="mrp[]"  placeholder="Enter MRP" required>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="price">Enter Price</label>
                            <input type="number" step="any" class="form-control" name="price[]"  placeholder="Enter Price" required>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="stock">Enter Stock</label>
                            <input type="number" step="any" class="form-control" name="stock[]"  placeholder="Enter Stock" min="1" value="1" required>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="min_ord_qtty">Minimum Order Quantity</label>
                            <input type="number" step="any" class="form-control" name="min_ord_qtty[]"  placeholder="Enter Minimum Order Quantity" min="1" value="1">
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="removeSizeDiv(${size_count})">Remove</a>
                        </div></div>`;
            $("#size_div").append(htmlSize);
            size_count++;
        }

        function removeSizeDiv(id) {
            $("#size_more_div"+id).remove();
            size_count--;
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
                        console.log(data);
                        $("#sub_category").html("<option value=''>Please Select First Category</option>");

                        $.each( data, function( key, value ) {
                            $("#sub_category").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });

                    }
                });
            });
        });

    </script>
 @endsection


        
    