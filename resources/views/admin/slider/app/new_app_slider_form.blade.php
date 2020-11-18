
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New App Slider</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                
                <div>
                    <div class="x_content">
                        
                            {{ Form::open(['method' => 'post','route'=>'admin.insert_app_slider','enctype'=>'multipart/form-data']) }}
                        <div class="well" style="overflow:auto">
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
                            <div class="form-row mb-3">                                
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
                            <div class="form-row mb-3">                                
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
                            <div class="well" style="overflow: auto" id="image_div">
                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="size">Images <span><b style="color: red"> *  Image Dimension Should Be (1920x504) </b></span></label>
                                        <input type="file" name="images[]" class="form-control" multiple required>
                                        @if($errors->has('images'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('images') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                           
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            
                            <a href="{{route('admin.web_slider_list')}}" class="btn btn-warning">Back</a>
                            
                        </div>
                        {{ Form::close() }}
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="clearfix"></div>
</div>
 @endsection
 @section('script')
    <script>
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
