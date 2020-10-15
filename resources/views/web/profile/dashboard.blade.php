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
                <div class="col-lg-10 col-12 ashia-mb-30 mx-auto">
                    <div class="dashboard row">
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.view_cart')}}"> <i class="far fa-shopping-cart"></i> Cart</a></div>
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.order_history')}}"> <i class="far fa-file-alt"></i> Orders</a></div>
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.wishlist')}}"> <i class="far fa-heart"></i> Wishlist</a></div>
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.address')}}"> <i class="far fa-map-marker-alt"></i> Address</a></div>
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.profile')}}"> <i class="far fa-user"></i> Profile</a></div>
                        <div class="col-lg-4 col-xs-6"><a href="{{route('web.index')}}"> <i class="far fa-sign-out-alt"></i> Logout</a></div>
                    </div>
                </div>
                <!-- My Account Tab List End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->
@endsection

@section('script')

@endsection
