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
                    <style>.myaccount-tab-list a:nth-child(2) {background: #ff6c62!important;color: #fff;}</style>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-10 col-12 ashia-mb-30">
                    <div class="tab-content">

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="dashboad">
                            <div class="myaccount-content dashboad">
                                <p>Hello <strong>didiv91396</strong> (not <strong>didiv91396</strong>? <a href="login-register.html">Log out</a>)</p>
                                <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade show active" id="orders">
                            <table class="cart-wishlist-table table">
                                <thead>
                                    <tr>
                                        <th class="name" colspan="2">Product</th>
                                        <th class="quantity">Quantity</th>
                                        <th class="price">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="pattern-bg">
                                    <tr>
                                        <td class="order-d" colspan="4">
                                            <b>Order Id: <span>AD1452GHY</span></b>
                                            <b>Order Date: <span>02/11/20</span></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thumbnail"><a href="product-details.html"><img src="{{asset('web/images/product/s328/product-1.jpg')}}"></a></td>
                                        <td class="name"> <a href="product-details.html">Walnut Cutting Board</a></td>
                                        <td class="quantity"><b>1</b></td>
                                        <td class="price"><span>£100.00</span></td>
                                    </tr>
                                    <tr>
                                        <td class="thumbnail"><a href="product-details.html"><img src="{{asset('web/images/product/s328/product-2.jpg')}}"></a></td>
                                        <td class="name"> <a href="product-details.html">Lucky Wooden Elephant</a></td>
                                        <td class="quantity"><b>1</b></td>
                                        <td class="price"><span>£35.00</span></td>
                                    </tr>
                                    <tr>
                                        <td class="thumbnail"><a href="product-details.html"><img src="{{asset('web/images/product/s328/product-3.jpg')}}"></a></td>
                                        <td class="name"> <a href="product-details.html">Fish Cut Out Set</a></td>
                                        <td class="quantity"><b>1</b></td>
                                        <td class="price"><span>£9.00</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{route('web.order.order')}}" class="btn btn-sm btn-outline-dark"> Back to orders</a></td>
                                        <td><a href="#" class="btn btn-sm btn-primary"> Cancel order</a></td>
                                        <td class="order-cal" style="border-left: 1px dashed #ff6c62!important;">
                                            <span>Subtotal</span>
                                            <span>Shipping</span>
                                        </td>
                                        <td class="order-cal">
                                            <span>₹1000</span>
                                            <span>₹100</span>
                                        </td>
                                    </tr>
                                    <tr class="gnd">
                                        <td></td>
                                        <td></td>
                                        <td class="order-grand" style="border-left: 1px dashed #ff6c62!important;">
                                            <span class="grand">Grand Total</span>
                                        </td>
                                        <td class="order-grand">
                                            <span class="grand">₹1100</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <style>.cart-wishlist-table tbody tr td.name a:hover {color: #ff6c62;}.price,.quantity{text-align:center}.order-d{padding:0!important;text-align: center}.order-d b{padding: 0 50px;}.order-d b span{color: #ff6c62;}table img{width: 50%;}</style>                        
                        <!-- Single Tab Content End -->

                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->
@endsection

@section('script')

@endsection
