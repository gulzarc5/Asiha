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
                                        <th class="action">Action</th>

                                    </tr>
                                </thead>
                                @if (isset($order))
                                    <tbody class="pattern-bg">
                                        <tr>
                                            <td class="order-d" colspan="6">
                                                <b>Order Id: <span>{{$order->id}}</span></b>
                                                <b>Order Date: <span>{{$order->created_at->format('d M Y')}}</span></b>
                                                <b>Payment Status:
                                                    <span>
                                                        @if ($order->payment_type == '1')
                                                            COD
                                                        @else
                                                            @if ($order->payment_status == '2')
                                                                Paid
                                                            @else
                                                                Failed
                                                            @endif
                                                        @endif
                                                    </span>
                                                </b>
                                            </td>
                                        </tr>
                                        @php
                                            $order_details = $order->orderDetails;
                                        @endphp
                                        @if (!empty($order_details) && (count($order_details) > 0))
                                            @foreach($order_details as $details)
                                            <tr>
                                                <td class="thumbnail"><a href="{{route('web.product_detail',['slug'=>$details->product->slug,'product_id'=>$details->product->id])}}"><img src="{{asset('images/products/'.$details->product->main_image.'')}}"></a></td>
                                                <td class="name"> <a href="{{route('web.product_detail',['slug'=>$details->product->slug,'product_id'=>$details->product->id])}}">{{$details->product->name}}</a></td>
                                                <td class="quantity"><b>{{$details->quantity}}</b></td>
                                                <td class="price"><span>{{$details->quantity * $details->price}}</span></td>
                                                <td class="price">
                                                    @if ($order->payment_status == '3')
                                                        <span>Payment Failed</span>
                                                    @elseif($details->order_status==1)
                                                        <span>New Order</span>
                                                    @elseif($details->order_status==2)
                                                        <span>Packed</span>
                                                    @elseif($details->order_status==3)
                                                        <span>Shipped</span>
                                                    @elseif($details->order_status==4)
                                                        <span>Delivered</span>
                                                    @elseif($details->order_status==5)
                                                        <span>Cancelled</span>
                                                    @elseif($details->order_status==6)
                                                        <span>Return Request</span>
                                                    @else
                                                        <span>Returned</span>
                                                    @endif
                                                </td>
                                                <td class="action">
                                                    @if ($order->payment_status == '3')

                                                    @elseif(($details->order_status == 1) || ($details->order_status == 2)  || ($details->order_status == 3))
                                                        @if ($order->payment_type == '1')
                                                            <a href="{{route('web.order_cancel',['id'=>$details->id])}}" class="btn btn-sm btn-primary"> Cancel order</a>
                                                        @else
                                                            @if (($order->payment_type == '2') && ($order->payment_status == '2'))
                                                                <a href="{{route('web.order_refund_form',['order_id'=>$details->id])}}" class="btn btn-sm btn-primary"> Cancel Item</a>
                                                            @else
                                                                <a href="{{route('web.order_cancel',['id'=>$details->id])}}" class="btn btn-sm btn-primary"> Cancel order</a>
                                                            @endif
                                                        @endif
                                                    @elseif(($details->order_status == 4))
                                                        <a href="{{route('web.order_refund_form',['order_id'=>$details->id,'form_type'=>'2'])}}" class="btn btn-sm btn-primary"> Return Item</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td><a href="{{route('web.order_history')}}" class="btn btn-sm btn-outline-dark"> Back to orders</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="order-cal" style="border-left: 1px dashed #ff6c62!important;">
                                                <span>Subtotal</span>
                                                @if(!empty($order->discount))
                                                    <span>Discount</span>
                                                @endif
                                                <span>Shipping</span>
                                            </td>
                                            <td class="order-cal">
                                                <span>{{$order->amount}}</span>
                                                @if(!empty($order->discount))
                                                    <span>{{$order->discount}}</span>
                                                @endif
                                                @if($order->shipping_charge>0)
                                                    <span>{{$order->shipping_charge}}</span>
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
                                                <span class="grand">{{$order->total_amount}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
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
