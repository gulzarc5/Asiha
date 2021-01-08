@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit Product</h2>
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
    	               
                            
                        
    	            	{{ Form::open(['method' => 'put','route'=>['admin.product_update',$product_id] , 'enctype'=>'multipart/form-data']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Product name <span><b style="color: red"> * </b></span></label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Product name" value="{{$product->name}}" >
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
                                                @if ($product->category_id == $cat->id)
                                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                                @else
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endif
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
                                        @if(isset($sub_category) && !empty($sub_category))
                                            @foreach($sub_category as $cat)
                                                @if ($product->sub_category_id == $cat->id)
                                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                                @else
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
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
                                      @if(isset($third_category) && !empty($third_category))
                                            @foreach($third_category as $cat)
                                                @if ($product->last_category_id == $cat->id)
                                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                                @else
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
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
                                      @if(isset($brand) && !empty($brand))
                                            @foreach($brand as $item)
                                                @if ($product->brand_id == $item->id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('brand'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @enderror      
                            </div>                            
                        </div>

                       <div class="well" style="overflow: auto" id="image_div">
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

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="short_description">Type Short Product Descrition</label>
                                    <textarea class="form-control" name="short_description" id="short_description">{{$product->short_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Long Product Descrition</label>
                                    <textarea class="form-control" name="description" id="description">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>

                       

    	            	<div class="form-group">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                                <button type="button" class="btn btn-danger" onclick="window.close();">Close Window</button>
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


        
    