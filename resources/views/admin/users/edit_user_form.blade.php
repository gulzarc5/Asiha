@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit User Details</h2>
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
    	               
                            
                        
    	            	{{ Form::open(['method' => 'put','route'=>['admin.user_update',$user_data->id] , 'enctype'=>'multipart/form-data']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name"> name <span><b style="color: red"> * </b></span></label>
                                  <input type="text" class="form-control" name="name"   value="{{$user_data->name}}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dob"> Date Of Birth  </label>
                                    <input type="date" class="form-control" name="dob" >
                                      @if($errors->has('dob'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('dob') }}</strong>
                                          </span>
                                      @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="email"> Email <span><b style="color: red"> * </b></span></label>
                                    <input type="email" class="form-control" value="{{$user_data->email}}" name="email" >
                                      @if($errors->has('email'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile"> Mobile <span><b style="color: red"> * </b></span></label>
                                    <input type="tel" class="form-control" value="{{$user_data->mobile}}" name="mobile" >
                                      @if($errors->has('mobile'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('mobile') }}</strong>
                                          </span>
                                      @enderror
                                </div>                       
                            </div>
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="state"> State </label>
                                    <input type="text" class="form-control" value="{{$user_data->state}}" name="state" >
                                      @if($errors->has('state'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('state') }}</strong>
                                          </span>
                                      @enderror
                                </div>                        
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                <label for="city"> City </label>
                                <input type="text" class="form-control" value="{{$user_data->city}}" name="city" >
                                  @if($errors->has('city'))
                                      <span class="invalid-feedback" role="alert" style="color:red">
                                          <strong>{{ $errors->first('city') }}</strong>
                                      </span>
                                  @enderror 
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                <label for="pin"> PIN </label>
                                <input type="text" class="form-control" value="{{$user_data->pin}}" name="pin" >
                                  @if($errors->has('pin'))
                                      <span class="invalid-feedback" role="alert" style="color:red">
                                          <strong>{{ $errors->first('pin') }}</strong>
                                      </span>
                                  @enderror 
                            </div>                              
                        </div>
                        <div class="well" style="overflow: auto" >
                            <div class="form-row mb-3">     
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" style="margin-top: 20px;">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="gender">Gender</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <p >  @if($user_data->gender=='M')
                                            <input type="radio" name="gender" checked value="M"> Male 
                                             <input type="radio" name="gender" value="F">  Female 
                                            @else
                                            <input type="radio" name="gender" checked value="F">Female 
                                            <input type="radio" name="gender"  value="M"> Male 
                                            @endif  
                                        </p>
                                    </div>
                                    
                                </div>
                        </div>              
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address">{{$user_data->address}}</textarea>
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

  
    
 @endsection


        
    