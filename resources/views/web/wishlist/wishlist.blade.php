@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
    <!-- Shopping Cart Section Start -->
    <div class="section section-padding bg-white border-top-dashed border-bottom-dashed">
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Product</th>
                            <th class="price text-center">Price</th>
                            <th class="remove text-center">action</th>
                        </tr>
                    </thead>
                    <tbody class="pattern-bg">
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-1.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Walnut Cutting Board</a></td>
                            <td class="product-info">
                                <span class="price">
                                    <span class="old">$45.00</span>
                                    <span class="new">$39.00</span>
                                </span>
                            </td>
                            <td class="remove text-center">
                                <a href="#" class="btn-light btn-outline-dark btn-sm">Remove</a>
                                <a href="{{route('web.cart.cart')}}" class="btn-primary btn-sm">Add to cart</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-2.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Lucky Wooden Elephant</a></td>
                            <td class="product-info">
                                <span class="price">
                                    <span class="old">$45.00</span>
                                    <span class="new">$39.00</span>
                                </span>
                            </td>
                            <td class="remove text-center">
                                <a href="#" class="btn-light btn-outline-dark btn-sm">Remove</a>
                                <a href="{{route('web.cart.cart')}}" class="btn-primary btn-sm">Add to cart</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="thumbnail"><a href="{{route('web.product.product-detail')}}"><img src="{{asset('web/images/product/s328/product-3.jpg')}}"></a></td>
                            <td class="name"> <a href="{{route('web.product.product-detail')}}">Fish Cut Out Set</a></td>
                            <td class="product-info">
                                <span class="price">
                                    <span class="old">$45.00</span>
                                    <span class="new">$39.00</span>
                                </span>
                            </td>
                            <td class="remove text-center">
                                <a href="#" class="btn-light btn-outline-dark btn-sm">Remove</a>
                                <a href="{{route('web.cart.cart')}}" class="btn-primary btn-sm">Add to cart</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

    </div>
    <!-- Shopping Cart Section End -->
    <style>.remove a{border: 1px solid;font-weight: 400;line-height: 24px;text-align: center;white-space: nowrap;letter-spacing: 1px;text-transform: uppercase;border-radius: 500px;}</style>
@endsection

@section('script')

@endsection
