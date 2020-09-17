
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($brands) && !empty($brands))
                        <h2>Update Brand</h2>
                    @else
                        <h2>Add New Brand</h2>
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
                        {{-- @if(isset($brands) && !empty($brands))
                            {{Form::model($brands, ['method' => 'put','route'=>['admin.brand_update',$brands->id],'enctype'=>'multipart/form-data'])}}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.brand_insert_form','enctype'=>'multipart/form-data']) }}
                        @endif --}}

                        <div class="form-group">
                            {{-- {{ Form::label('name', 'Brand Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Brand name')) }} --}}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('category', 'Select Category')}} 
                            {{-- @if (isset($brands)) --}}
                                {!! Form::select('category', $category, $brands->category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']); !!}
                            {{-- @else --}}
                                {!! Form::select('category', $category, null, ['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']) !!}
                            {{-- @endif --}}

                            @if($errors->has('category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- {{ Form::label('sub_category', 'Select Sub Category')}} 
                            @if (isset($brands))
                                {!! Form::select('sub_category', $sub_category, $brands->sub_category_id,['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'sub_category']); !!}
                            @else --}}
                                <select class="form-control" name="sub_category" id="sub_category">
                                    <option value="">Please Select Sub Category</option>
                                {{-- </select>
                            @endif --}}

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
                            <a href="{{route('admin.brand_list')}}" class="btn btn-warning">Back</a>
                            
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