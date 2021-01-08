
@extends('admin.template.admin_master')

@section('content')
<link href="{{asset('admin/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($colors) && !empty($colors))
                        <h2>Update Color</h2>
                    @else
                        <h2>Add New Color</h2>
                    @endif
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
                        @if(isset($colors) && !empty($colors))
                            {{Form::model($colors, ['method' => 'put','route'=>['admin.color_update',$colors->id],'enctype'=>'multipart/form-data'])}}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.color_insert_form','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::label('name', 'Name')}} 
                               {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Color name')) }} 
                               @if($errors->has('name'))
                                   <span class="invalid-feedback" role="alert" style="color:red">
                                       <strong>{{ $errors->first('name') }}</strong>
                                   </span> 
                               @enderror
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>Color</label>
                                @if (isset($colors))
                                <div class="input-group demo2">
                                    <input type="text"  class="form-control"  value="{{$colors->color}}" name="color" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                                @else
                                <div class="input-group demo2">
                                    <input type="text"  class="form-control" name="color" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                                @endif
                                @if($errors->has('color'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('category', 'Select Category')}} 
                            @if (isset($colors))
                                {!! Form::select('category', $category, $colors->category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']); !!}
                           @else 
                                {!! Form::select('category', $category, null, ['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']) !!}
                            @endif

                            @if($errors->has('category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                             {{ Form::label('sub_category', 'Select Sub Category')}} 
                            @if (isset($colors))
                                {!! Form::select('sub_category', $sub_category, $colors->sub_category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'sub_category']); !!}
                            @else 
                                <select class="form-control" name="sub_category" id="sub_category">
                                    <option value="">Please Select Sub Category</option>
                                 </select>
                            @endif

                            @if($errors->has('category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span> 
                            @enderror
                        </div>

                       

                        <div class="form-group">
                            @if(isset($sub_category) && !empty($sub_category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.color_list')}}" class="btn btn-warning">Back</a>
                            
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
 <script src="{{asset('admin/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
     
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
                        console.log(data);
                        $("#sub_category").html("<option value=''>Please Select Sub Category</option>");

                        $.each( data, function( key, value ) {
                            $("#sub_category").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });

                    }
                });
            });
        });
     </script>
 @endsection