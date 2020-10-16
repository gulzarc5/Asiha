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
                                        <th class="status">Status</th>
                                        @if($orders->order_status !=5)
                                            <th class="action">Action</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody class="pattern-bg">
                                   <tr>
                                        <td class="order-d" colspan="4">
                                            <b>Order Id: <span>{{$orders->id}}</span></b>
                                            <b>Order Date: <span>{{$orders->created_at->format('d M Y')}}</span></b>
                                        </td>
                                    </tr>
                                    @foreach($order_details as $details)
                                    <tr>
                                        <td class="thumbnail"><a href="product-details.html"><img src="{{asset('images/products/'.$details->product->main_image.'')}}"></a></td>
                                        <td class="name"> <a href="product-details.html">{{$details->product->name}}</a></td>
                                        <td class="quantity"><b>{{$details->quantity}}</b></td>
                                        <td class="price"><span>{{$details->quantity * $details->price}}</span></td>
                                        @if($details->order_status==1)
                                            <td class="price"><span>New Order</span></td>
                                        @elseif($details->order_status==2)
                                            <td class="price"><span>Packed</span></td>
                                        @elseif($details->order_status==3)
                                            <td class="price"><span>Shipped</span></td>
                                        @elseif($details->order_status==4)
                                            <td class="price"><span>Delivered</span></td>
                                        @elseif($details->order_status==5)    
                                            <td class="price"><span>Cancelled</span></td>
                                        @elseif($details->order_status==6)
                                            <td class="price"><span>Return Request</span></td>
                                        @else
                                            <td class="price"><span>Returned</span></td>
                                        @endif
                                        @if($details->order_status!=5)
                                            @if($details->payment_type==1)
                                                <td class="action"><a href="{{route('web.order_cancel',['id'=>$details->id])}}" class="btn btn-sm btn-primary"> Cancel order</a></td>
                                            @else
                                                <td class="action"><a href="{{route('web.order.refund')}}" class="btn btn-sm btn-primary"> Cancel order</a></td>
                                            @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><a href="{{route('web.order_history')}}" class="btn btn-sm btn-outline-dark"> Back to orders</a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="order-cal" style="border-left: 1px dashed #ff6c62!important;">
                                            <span>Subtotal</span>
                                            @if(!empty($orders->discount))
                                                <span>Discount</span>
                                            @endif
                                            <span>Shipping</span>
                                        </td>
                                        <td class="order-cal">
                                            <span>{{$orders->amount}}</span>
                                            @if(!empty($orders->discount))
                                                <span>{{$orders->discount}}</span>
                                            @endif
                                            @if($orders->shipping_charge>0)
                                                <span>{{$orders->shipping_charge}}</span>
                                            @else
                                                <span>Free</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="gnd">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="order-grand" style="border-left: 1px dashed #ff6c62!important;">
                                            <span class="grand">Grand Total</span>
                                        </td>
                                        <td class="order-grand">
                                            @if(!empty($orders->discount))
                                                <span class="grand">{{($orders->discount/100*$orders->amount)+ $orders->shipping_charge}}</span>
                                            @else
                                                <span class="grand">{{$orders->amount+ $orders->shipping_charge}}</span>
                                            @endif
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
