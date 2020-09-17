
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($sizes) && !empty($sizes))
                        <h2>Update Size</h2>
                    @else
                        <h2>Add New Size</h2>
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
                        @if(isset($sizes) && !empty($sizes))
                            {{Form::model($sizes, ['method' => 'put','route'=>['admin.size_update',$sizes->id]])}}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.size_insert']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Size ')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Size')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('category', 'Select Category')}} 
                            @if (isset($sizes))
                                {!! Form::select('category', $category, $sizes->category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']); !!}
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
                            @if (isset($sizes))
                                {!! Form::select('sub_category', $sub_category, $sizes->sub_category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'sub_category']); !!}
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
                            @if(isset($sizes) && !empty($sizes))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.size_list')}}" class="btn btn-warning">Back</a>
                            
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