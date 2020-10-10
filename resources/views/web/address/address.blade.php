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
                    <style>.myaccount-tab-list a:nth-child(4) {background: #ff6c62!important;color: #fff;}</style>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-10 col-12 ashia-mb-30">
                    <div class="accordion" id="faq-accordion">
                        <div class="card active">
                            <div class="card-header">
                                <button class="btn btn-link">Shipping Address</button>
                            </div>
                            <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                <div class="card-body pattern-bg">
                                    <div class="myaccount-content address" id="selt-add">
                                        @if (Session::has('message'))
                                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                                            @endif @if (Session::has('error'))
                                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                            @endif
                                        <div class="row ashia-mb-n30">
                                            @foreach($address as $data)
                                                @if(!empty($data) && isset($data))
                                                    <div class="col-md-4 col-12 ashia-mb-30">
                                                        <address>                                                        
                                                            <p><strong>{{$data->name}}</strong></p>
                                                            <p>{{$data->address}}</p>
                                                            <p class="mb-0">Mobile: {{$data->mobile}}</p>
                                                            <p class="mb-0">Email: {{$data->email}}</p>
                                                            <p class="mb-0">city: {{$data->city}}</p>
                                                            <p class="mb-0">State: {{$data->state}}</p>
                                                            <p class="mb-0">Pin: {{$data->pin}}</p>
                                                            <a href="{{route('web.edit_address',['id'=>$data->id,'status'=>2])}}" class="edit-link">edit this address</a>
                                                            <a href="{{route('web.delete_address',['address_id'=>$data->id])}}" class="edit-link">Delete this address</a>
                                                        </address>
                                                    </div>
                                                @endif
                                            @endforeach
                                            
                                            <div class="col-12 mb-4">
                                                <p class="add-address" style="display: inline;cursor:pointer"><span style="color: #ff6c62;">Add New Address<span></p>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="myaccount-content address" id="add-addr" style="display:none">
                                        <h3>Add New Address</h3>
                                        <form method="POST" action="{{route('web.add_new_address')}}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputName4">Name</label>
                                                    <input type="text" name="name" class="form-control" id="inputName4" >
                                                    @if($errors->has('name'))
                                                        <strong style="color:red" >{{ $errors->first('name') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">Email</label>
                                                    <input type="email" name="email" class="form-control" id="inputEmail4">
                                                    @if($errors->has('email'))
                                                        <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPhone4">Phone</label>
                                                    <input type="text" name="mobile" class="form-control" id="inputPhone4" >
                                                    @if($errors->has('mobile'))
                                                        <strong style="color:red" >{{ $errors->first('mobile') }}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">Address</label>
                                                <textarea id="inputAddress" name="address" ></textarea>
                                                @if($errors->has('address'))
                                                    <strong style="color:red" >{{ $errors->first('address') }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity">City</label>
                                                    <input type="text" name="city" class="form-control" id="inputCity">
                                                    @if($errors->has('city'))
                                                        <strong style="color:red" >{{ $errors->first('city') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">State</label>
                                                    <input type="text" name="state" class="form-control" id="inputState">
                                                    @if($errors->has('state'))
                                                        <strong style="color:red" >{{ $errors->first('state') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPincode">Pincode</label>
                                                    <input type="number" name="pin" class="form-control" id="inputPincode">
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
