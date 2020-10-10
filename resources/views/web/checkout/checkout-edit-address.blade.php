@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
        <!-- My Account Section Start -->
        <div class="section section-padding bg-white border-bottom-dashed">
            <div class="container">
                <div class="row ashia-mb-n30">
    
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-10 col-12 ashia-mb-30 mx-auto">
                        <div class="accordion" id="faq-accordion">
                            <div class="card active">
                                <div class="card-header">
                                    <button class="btn btn-link">Shipping Address</button>
                                </div>
                                <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        @if (Session::has('message'))
                                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                                        @endif @if (Session::has('error'))
                                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                        @endif
                                        <div class="myaccount-content address">
                                            <h3>Edit Address</h3>
                                            <form method="POST" action="{{route('web.update_address',['id'=>$address->id])}}">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputName4">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{$address->name}}">
                                                        @if($errors->has('name'))
                                                            <strong style="color:red" >{{ $errors->first('name') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{$address->email}}">
                                                        @if($errors->has('email'))
                                                            <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputPhone4">Phone</label>
                                                        <input type="text" name="mobile" class="form-control" value="{{$address->mobile}}">
                                                        @if($errors->has('mobile'))
                                                            <strong style="color:red" >{{ $errors->first('mobile') }}</strong>
                                                         @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <textarea name="address" value="">{{$address->address}}</textarea>
                                                    @if($errors->has('address'))
                                                        <strong style="color:red" >{{ $errors->first('address') }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" name="city" class="form-control" value="{{$address->city}}">
                                                        @if($errors->has('city'))
                                                            <strong style="color:red" >{{ $errors->first('city') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <input type="text" name="state" class="form-control" value="{{$address->state}}">
                                                        @if($errors->has('state'))
                                                            <strong style="color:red" >{{ $errors->first('state') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputPincode">Pincode</label>
                                                        <input type="text" name="pin" class="form-control" value="{{$address->pin}}">
                                                        @if($errors->has('pin'))
                                                            <strong style="color:red" >{{ $errors->first('pin') }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <a href="{{route('web.show_checkout_form')}}" class="btn btn-sm btn-outline-dark mr-3">Back to checkout</a>
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
