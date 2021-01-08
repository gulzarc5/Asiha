
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($coupons) && !empty($coupons))
                        <h2>Update Coupon</h2>
                    @else
                        <h2>Add New Coupon</h2>
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

                    @if(isset($coupons) && !empty($coupons))
                    <div class="x_content">
                            {{Form::model($coupons, ['method' => 'put','route'=>['admin.coupon_update',$coupons->id],'enctype'=>'multipart/form-data'])}}


                        <div class="form-group">
                            {{ Form::label('code', 'Coupon Code')}}
                            {{ Form::text('code',null,array('class' => 'form-control')) }}

                           @if($errors->has('code'))
                               <span class="invalid-feedback" role="alert" style="color:red">
                                   <strong>{{ $errors->first('code') }}</strong>
                               </span>
                           @enderror
                       </div>

                       <div class="form-group">
                            {{ Form::label('discount', 'Discount (In Percentage)')}}
                            {{ Form::number('discount',null,array('class' => 'form-control')) }}

                            @if($errors->has('code'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('description', 'Enter Coupon Details')}}
                            {{ Form::textarea('description',null,array('class' => 'form-control')) }}

                            @if($errors->has('code'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('image', 'Select Coupon Image')}}
                            {{ Form::file('image',null,array('class' => 'form-control')) }}

                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            @if(isset($coupons) && !empty($coupons))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.coupon_list')}}" class="btn btn-warning">Back</a>

                        </div>
                        {{ Form::close() }}

                    </div>
                    @endif
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
