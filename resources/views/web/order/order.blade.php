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
                                        <th class="name">Product</th>
                                        <th class="price">Status</th>
                                        <th class="subtotal">Order Date</th>
                                        <th class="subtotal">Order Amount</th>
                                        <th class="remove">View</th>
                                    </tr>
                                </thead>
                                <tbody class="pattern-bg">
                                    <tr>
                                        <td class="name">
                                            <a href="product-details.html"> Walnut Cutting Board,</a>
                                            <a href="product-details.html"> Lucky Wooden Elephant,</a>
                                            <a href="product-details.html"> Fish Cut Out Set</a>
                                        </td>
                                        <td class="price"><span>Pending</span></td>
                                        <td class="subtotal"><span>02/10/20</span></td>
                                        <td class="subtotal"><span>₹1000</span></td>
                                        <td class="remove">
                                            <a href="{{route('web.order.order-detail')}}" class="btn"><i class="fal fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="name">
                                            <a href="product-details.html"> Walnut Cutting Board,</a>
                                            <a href="product-details.html"> Fish Cut Out Set</a>
                                        </td>
                                        <td class="price"><span>Recevied</span></td>
                                        <td class="subtotal"><span>02/10/20</span></td>
                                        <td class="subtotal"><span>₹900</span></td>
                                        <td class="remove">
                                            <a href="{{route('web.order.order-detail')}}" class="btn"><i class="fal fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="name">
                                            <a href="product-details.html"> Lucky Wooden Elephant</a>
                                        </td>
                                        <td class="price"><span>Canceled</span></td>
                                        <td class="subtotal"><span>02/10/20</span></td>
                                        <td class="subtotal"><span>₹400</span></td>
                                        <td class="remove">
                                            <a href="{{route('web.order.order-detail')}}" class="btn"><i class="fal fa-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <style>.cart-wishlist-table tbody tr td.name{display:grid; color:#ff6c62}.cart-wishlist-table tbody tr td.name a:hover {color: #ff6c62;}.price,.subtotal{text-align:center}</style>                        
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
