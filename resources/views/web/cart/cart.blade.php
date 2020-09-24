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
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-1.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Walnut Cutting Board</a></td>
                            <td class="price"><span>£100.00</span></td>
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
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-2.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Lucky Wooden Elephant</a></td>
                            <td class="price"><span>£35.00</span></td>
                            <td class="quantity">
                                <div class="product-quantity">
                                    <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                    <input type="text" class="input-qty" value="1">
                                    <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                </div>
                            </td>
                            <td class="subtotal"><span>£35.00</span></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        </tr>
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-3.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Fish Cut Out Set</a></td>
                            <td class="price"><span>£9.00</span></td>
                            <td class="quantity">
                                <div class="product-quantity">
                                    <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                    <input type="text" class="input-qty" value="1">
                                    <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                </div>
                            </td>
                            <td class="subtotal"><span>£9.00</span></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        </tr>
                        <tr>
                            <td><a href="index.php" class="btn btn-sm btn-outline-dark"> countinue Shopping</a></td>
                            <td><a href="checkout.php" class="btn btn-sm btn-primary"> proceed to checkout</a></td>
                            <td colspan="2"></td>
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
