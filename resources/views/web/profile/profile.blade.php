@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
    <!-- My Account Section Start -->
    <div class="section section-padding bg-white border-bottom-dashed">
        <div class="container">
            <div class="row ashia-mb-n30">

                <!-- My Account Tab List Start -->
                <div class="col-lg-2 col-12 ashia-mb-30">
                    @include('web.include.acount-sidepanel')
                    <style>.myaccount-tab-list a:nth-child(5) {background: #ff6c62!important;color: #fff;}</style>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-10 col-12 ashia-mb-30">
                    <div class="accordion" id="faq-accordion">
                        <div class="card active">
                            <div class="card-header">
                                <button class="btn btn-link">Profile</button>
                            </div>
                            <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                <div class="card-body pattern-bg">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                                    @endif @if (Session::has('error'))
                                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                    @endif
                                    <div class="myaccount-content address" id="selt-add">
                                        <div class="row ashia-mb-n30">

                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Name</label>
                                                <p>{{$user_data->name}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Email</label>
                                                <p>{{$user_data->email}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Phone</label>
                                                <p>{{$user_data->mobile}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">gender</label>
                                                <p>{{$user_data->gender}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Dob</label>
                                                <p>{{$user_data->dob}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">State</label>
                                                <p>{{$user_data->state}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">City</label>
                                                <p>{{$user_data->city}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Address</label>
                                                <p>{{$user_data->address}}</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">PIN</label>
                                                <p>{{$user_data->pin}}</p>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <p class="add-address" style="display: inline;cursor:pointer"><span style="color: #ff6c62;">Edit Profile<span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="myaccount-content address" id="add-addr" style="display:none">
                                        <h3>Edit Profile</h3>
                                        <form action="{{route('web.update_profile',['id'=>$user_data->id])}}" method="POST" >
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputName4">Name</label>
                                                    <input type="text" name ="username" class="form-control" value = {{$user_data->name}} placeholder="Name">
                                                    @if($errors->has('username'))
                                                        <strong style="color:red" >{{ $errors->first('username') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="dob">Dob</label>
                                                    <input type="date" name ="dob" class="form-control" value = {{$user_data->dob}} placeholder="dob">
                                                    @if($errors->has('dob'))
                                                        <strong style="color:red" >{{ $errors->first('dob') }}</strong>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">Email</label>
                                                    <input type="email" name="email" class="form-control" value= {{$user_data->email}}  placeholder="Email">
                                                    @if($errors->has('email'))
                                                        <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="gender">Gender</label>
                                                    @if($user_data->gender=='M')
                                                        <input type="radio" name="gender" checked value="M"> Male
                                                        <input type="radio" name="gender" value="F">  Female
                                                    @else
                                                        <input type="radio" name="gender" checked value="F">Female
                                                        <input type="radio" name="gender"  value="M"> Male
                                                    @endif
                                                    @if($errors->has('dob'))
                                                        <strong style="color:red" >{{ $errors->first('dob') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">Phone</label>
                                                    <input type="tel" name="mobile" class="form-control" value = {{$user_data->mobile}}  placeholder="Phone">
                                                    @if($errors->has('mobile'))
                                                        <strong style="color:red" >{{ $errors->first('mobile') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">State</label>
                                                    <input type="text" name="state" class="form-control" value ="{{$user_data->state}}"  placeholder="State">
                                                    @if($errors->has('state'))
                                                        <strong style="color:red" >{{ $errors->first('state') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">City</label>
                                                    <input type="text" name="city" class="form-control" value ="{{$user_data->city}}"  placeholder="City">
                                                    @if($errors->has('city'))
                                                        <strong style="color:red" >{{ $errors->first('city') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">Address</label>
                                                    <textarea name="address">{{$user_data->address}}</textarea>
                                                    @if($errors->has('address'))
                                                        <strong style="color:red" >{{ $errors->first('address') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">PIN</label>
                                                    <input type="text" name="pin" class="form-control" value ="{{$user_data->pin}}"  placeholder="Pin">
                                                    @if($errors->has('pin'))
                                                        <strong style="color:red" >{{ $errors->first('pin') }}</strong>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group mb-0">
                                                <a class="btn btn-sm btn-outline-dark mr-3 bck-selt">Cancel</a>
                                                <button class="btn btn-sm btn-primary text-white">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->

@endsection

@section('script')

@endsection
