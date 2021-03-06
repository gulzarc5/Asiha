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
                                    <button class="btn btn-link">Refund Information</button>
                                </div>
                                <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="myaccount-content address">
                                            @if (isset($form_type) && $form_type == '2')
                                                <h3>Return Refund Amount</h3><div class="product-price">{{$refund_amount}}/- </div>
                                                <form method="POST" action="{{route('web.order_refund',['order_id'=>$order_item->id])}}">
                                                <input type="hidden" name="form_type" value="2">
                                            @else
                                                <h3>Cancellation Refund Amount</h3><div class="product-price">{{$refund_amount}}/- </div>
                                                <form method="POST" action="{{route('web.order_refund',['order_id'=>$order_item->id])}}">
                                                <input type="hidden" name="form_type" value="1">
                                            @endif
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputName4">Account Holder Name</label>
                                                        <input type="text" name="name" class="form-control" value="">
                                                        @if($errors->has('name'))
                                                            <strong style="color:red" >{{ $errors->first('name') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Bank Name</label>
                                                        <input type="text" name="b-name" class="form-control" value="">
                                                        @if($errors->has('email'))
                                                            <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputPhone4">Account Number</label>
                                                        <input type="text" name="acc-number" class="form-control" value="">
                                                        @if($errors->has('mobile'))
                                                            <strong style="color:red" >{{ $errors->first('mobile') }}</strong>
                                                         @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputCity">IFSC Code</label>
                                                        <input type="text" name="ifsc" class="form-control" value="">
                                                        @if($errors->has('ifsc'))
                                                            <strong style="color:red" >{{ $errors->first('ifsc') }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Branch Name</label>
                                                        <input type="text" name="branch_name" class="form-control" value="">
                                                        @if($errors->has('branch_name'))
                                                            <strong style="color:red" >{{ $errors->first('branch_name') }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <a href="{{route('web.order_history')}}" class="btn btn-sm btn-outline-dark"> Back to orders</a>
                                                    <button class="btn btn-sm btn-primary text-white">Request Refund</button>
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
