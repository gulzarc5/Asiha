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
                                    @foreach($orders as $order_details)
                                    <tr> 
                                        <td class="name">
                                            @foreach($order_details->orderDetails as $items)
                                                <a href="product-details.html"> {{$items->product->name}}</a>
                                            @endforeach
                                        </td>
                                        @if($order_details->order_status==1)
                                            <td class="price"><span>New Order</span></td>
                                        @elseif($order_details->order_status==2)
                                            <td class="price"><span>Packed</span></td>
                                        @elseif($order_details->order_status==3)
                                            <td class="price"><span>Shipped</span></td>
                                        @elseif($order_details->order_status==4)
                                            <td class="price"><span>Delivered</span></td>
                                        @elseif($order_details->order_status==5)    
                                            <td class="price"><span>Cancel</span></td>
                                        @elseif($order_details->order_status==6)
                                            <td class="price"><span>Return Request</span></td>
                                        @else
                                            <td class="price"><span>Returned</span></td>
                                        @endif
                                        <td class="subtotal"><span>{{ $order_details->created_at->format('d M Y')}}</span></td>
                                        <td class="subtotal"><span>{{$order_details->total_amount}}</span></td>
                                        <td class="remove">
                                            <a href="{{route('web.order_details',['id'=>$order_details->id])}}" class="btn"><i class="fal fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                   
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
