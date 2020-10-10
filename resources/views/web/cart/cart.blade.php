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
                        @if(!empty($cart_data) && count($cart_data)>0)
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
                                           @if(!empty($values['cart_id']))
                                           
                                                <span class="qty-btn minus" onclick="loadCart({{$values['product_id']}},{{$values['cart_id']}},1)"><i class="ti-minus"></i></span>
                                                <input type="text"  class="input-qty" value="{{$values['quantity']}}" id="qtty{{$values['product_id']}}"/>
                                                <span class="qty-btn plus" onclick="loadCart({{$values['product_id']}},{{$values['cart_id']}},2)"><i class="ti-plus"></i></span>
                                            @else
                                                <span class="qty-btn minus" onclick="loadSessionCart({{$values['product_id']}},1)"><i class="ti-minus"></i></span>
                                                <input type="text"  class="input-qty" value="{{$values['quantity']}}" id="qtty{{$values['product_id']}}"/>
                                                <span class="qty-btn plus" onclick="loadSessionCart({{$values['product_id']}},2)"><i class="ti-plus"></i></span>
                                            @endif
                                        </div>
                                       
                                    </td>
                                    <td class="subtotal"><span>{{$values['product_total']}}</span></td>
                                    <td class="remove" id="rel"><a href="{{route('web.remove_cart',['id'=>$values['product_id']])}}" class="btn">×</a></td>
                                </tr>
                            @endforeach
                        
                            <tr>
                                <td><a href="{{route('web.index')}}" class="btn btn-sm btn-outline-dark"> countinue Shopping</a></td>
                                <td><a href="{{route('web.show_checkout_form')}}" class="btn btn-sm btn-primary"> proceed to checkout</a></td>
                                <td colspan="2"></td>
                                <td class="order-cal" style="border-left: 1px dashed #ff6c62!important;">
                                    <span>Subtotal</span>
                                    <span>Shipping</span>
                                </td>
                                <td class="order-cal">
                                    
                                    <span>{{$cart_total}}</span>
                                    <span>{{$shipping_charge}}</span>
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
                                    <span class="grand">{{$cart_total + $shipping_charge}}</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </form>
        </div>

    </div>
    <!-- Shopping Cart Section End -->
@endsection

@section('script')
    <script>
        function loadCart(id,cart_id,status) {
            var qtty = parseInt($("#qtty"+id).val());
            if (status == 1) {
                qtty= qtty - 1;
            }else{
                qtty = qtty+1;
            }
            var url = "{{ url('user/update/cart')}}"+"/"+id+"/"+cart_id+"/"+qtty;
            document.location.href=url;
            
        }
        function loadSessionCart(id,status) {
            var qtty = parseInt($("#qtty"+id).val());
            if (status == 1) {
                qtty= qtty - 1;
            }else{
                qtty = qtty+1;
            }
            var url = "{{ url('user/update/session/cart')}}"+"/"+id+"/"+qtty;
            document.location.href=url;
            
        }
    </script>
@endsection
