
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($coupons) && !empty($coupons))
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
                        @if(isset($coupons) && !empty($coupons))
                            {{Form::model($coupons, ['method' => 'put','route'=>['admin.coupon_update',$coupons->id],'enctype'=>'multipart/form-data'])}}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.coupon_insert_form','enctype'=>'multipart/form-data']) }}
                         @endif 

                        <div class="form-group">
                            {{ Form::label('code', 'Coupon Code')}} 
                            @if(isset($coupons) && !empty($coupons))
                            {{ Form::text('code',null,array('class' => 'form-control','value'=>$coupons->code)) }}
                            @else
                           {{ Form::text('code',null,array('class' => 'form-control','placeholder'=>'Enter Coupon Code')) }} 
                           @endif
                           @if($errors->has('code'))
                               <span class="invalid-feedback" role="alert" style="color:red">
                                   <strong>{{ $errors->first('code') }}</strong>
                               </span> 
                           @enderror
                       </div>

                       

                        <div class="form-group">
                            {{ Form::label('User Type', 'Select User Type')}} 
                           
                            @if (isset($coupons))
                               {!! Form::select('user_type', array('1' => 'New User', '2' => 'Old User'), $coupons->usertype, ['class' => 'form-control','placeholder'=>'Please Select User Type','id'=>'user_type','value']) !!}
                            @else
                                {!! Form::select('user_type', array('1' => 'New User', '2' => 'Old User'), null, ['class' => 'form-control','placeholder'=>'Please Select User Type','id'=>'user_type','value']) !!}
                            @endif
                                
                           

                            @if($errors->has('user_type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('user_type') }}</strong>
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