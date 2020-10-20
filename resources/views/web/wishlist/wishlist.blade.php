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
                        @foreach($wishlist as $item)
                            <tr>

                                <td class="thumbnail"><a href="{{route('web.product_detail',['slug'=>$item->product->slug,'product_id'=>$item->product_id])}}"><img src="{{asset('images/products/thumb/'.$item->product->main_image.'')}}"></a></td>
                                <td class="name"> <a href="{{route('web.product_detail',['slug'=>$item->product->slug,'product_id'=>$item->product_id])}}">{{$item->product->name}}</a></td>
                                <td class="product-info">
                                    <span class="price">
                                        <span class="old">{{$item->product->mrp}}</span>
                                        <span class="new">{{$item->product->min_price}}</span>
                                    </span>
                                </td>
                                <td class="remove text-center">
                                    <a href="{{route('web.remove_wishlist',['product_id'=>$item->id])}}" class="btn-light btn-outline-dark btn-sm">Remove</a>
                                    <a href="{{route('web.add_direct_cart',['product_id'=>$item->product->id])}}" class="btn-primary btn-sm">Add to cart</a>
                                </td>
                            </tr>
                        @endforeach
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
