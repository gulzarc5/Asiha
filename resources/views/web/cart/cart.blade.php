@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
    <!-- Shopping Cart Section Start -->
    <div class="section section-padding bg-white border-top-dashed border-bottom-dashed">
        <div class="container">
            <div class="order-nav mb-3">
                <ul>
                    <li class="navi current">Cart</li>
                    <li><i class="ti-angle-right"></i></li>
                    <li class="navi">Login</li>
                    <li><i class="ti-angle-right"></i></li>
                    <li class="navi">Checkout</li>
                    <li><i class="ti-angle-right"></i></li>
                    <li class="navi">Order Placed</li>
                </ul>
            </div>
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Product</th>
                            <th class="price">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="subtotal">Total</th>
                            <th class="remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody class="pattern-bg">
                        @foreach($cart_data as $values)
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('images/products/'.$values['image'])}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">
                                {{$values['name']}} 
                                @if(!empty(($values['color'])))
                                    <br>
                                    <div style="background-color:{{$values['color']}};height: 15px;width: 27px;"></div>
                                @endif
                                <br><span style="color:red;">Size: </span>{{$values['size']}}
                            </a></td>
                            <td class="price"><span>{{$values['price']}}</span></td>
                            <td class="quantity">
                                <div class="product-quantity">
                                    <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                    <input type="text" class="input-qty" value="1">
                                    <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                </div>
                            </td>
                            <td class="subtotal"><span>£100.00</span></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        
                        </tr>
                        @endforeach
                        <tr>
                            <td><a href="index.php" class="btn btn-sm btn-outline-dark"> countinue Shopping</a></td>
                            <td><a href="checkout.php" class="btn btn-sm btn-primary"> proceed to checkout</a></td>
                            <td colspan="2"></td>
                            <td class="order-cal" style="border-left: 1px dashed #ff6c62!important;">
                                <span>Subtotal</span>
                                <span>Shipping</span>
                            </td>
                            <td class="order-cal">
                                <span>{{$cart_total}}</span>
                                <span>₹100</span>
                             </td>
                        </tr>
                        
                        <tr class="gnd">
                            <td></td>
                            <td></td>
                            <td colspan="2"></td>
                            <td class="order-grand" style="border-left: 1px dashed #ff6c62!important;">
                                <span class="grand">Grand Total</span>
                            </td>
                            <td class="order-grand">
                                <span class="grand">₹1100</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

    </div>
    <!-- Shopping Cart Section End -->
@endsection

@section('script')

@endsection
