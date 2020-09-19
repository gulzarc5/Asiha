@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
        <!-- site__header / end -->
        <!-- site__body -->
        <div class="site__body">
            <div class="block-header block-header--has-breadcrumb block-header--has-title">
                <div class="container-fluid">
                    <div class="block-header__body">
                        <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb__list">
                                <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                                <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{route('web.index')}}" class="breadcrumb__item-link">Home</a></li>
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Cart</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="container-fluid">
                    <div class="cart">
                        @if ( isset($cartData) && !empty($cartData) && (count($cartData) > 0))
                        @php
                            $cart_total = 0;
                        @endphp
                        <div class="cart__table cart-table">
                            <table class="cart-table__table">
                                <thead class="cart-table__head">
                                    <tr class="cart-table__row">
                                        <th class="cart-table__column cart-table__column--image">Image</th>
                                        <th class="cart-table__column cart-table__column--product">Product</th>
                                        <th class="cart-table__column cart-table__column--price">Size</th>
                                        <th class="cart-table__column cart-table__column--price">Price</th>
                                        <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                                        <th class="cart-table__column cart-table__column--total">Total</th>
                                        <th class="cart-table__column cart-table__column--remove"></th>
                                    </tr>
                                </thead>
                                <tbody class="cart-table__body">
                                   
                                    @foreach($cartData as  $cart)
                                    @php
                                        $cart_total+= $cart['quantity']*$cart['price'];
                                    @endphp
                                    <tr class="cart-table__row">
                                        <td class="cart-table__column cart-table__column--image">
                                            <a href="#"><img src="{{asset('/images/products/'.$cart['product_image'])}}" alt=""></a>
                                        </td>
                                        <td class="cart-table__column cart-table__column--product"><a href="#" class="cart-table__product-name">{{$cart['product_name']}}</a>
                                            {{-- <ul class="cart-table__options">
                                                <li>Color: Yellow</li>
                                                <li>Material: Aluminium</li>
                                            </ul> --}}
                                        </td>
                                        <td class="cart-table__column cart-table__column--price" data-title="Size">{{$cart['size_name']}}</td>
                                        <td class="cart-table__column cart-table__column--price" data-title="Price">{{number_format($cart['price'], 2)}}</td>
                                        <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                                            <div class="cart-table__quantity input-number">
                                                <input class="form-control input-number__input" type="number" min="1" value="{{$cart['quantity']}}" onchange="updateCart(this.value,{{$cart['cart_id']}})">
                                                <div class="input-number__add"></div>
                                                <div class="input-number__sub"></div>
                                            </div>
                                        </td>
                                        <td class="cart-table__column cart-table__column--total" data-title="Total">{{number_format($cart['quantity'] * $cart['price'], 2)}}</td>
                                        <td class="cart-table__column cart-table__column--remove">
                                            <a href="{{route('web.cart_remove',['cart_id'=>$cart['cart_id']])}}" class="cart-table__remove btn btn-sm btn-icon btn-muted ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                                        <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                        c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                        C11.2,9.8,11.2,10.4,10.8,10.8z" />
                                                    </svg>
                                                </a>
                                            </td>
                                 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cart__totals">
                            <div class="card">
                                <div class="card-body card-body--padding--2">
                                    <h3 class="card-title">Cart Totals</h3>
                                    <table class="cart__totals-table">
                                        {{-- <thead>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>$5,877.00</td>
                                            </tr>
                                        </thead> --}}
                                        {{-- <tbody> --}}
                                            {{-- <tr>
                                                <th>Shipping</th>
                                                <td>$25.00
                                                    <div><a href="#">Calculate shipping</a></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td>$0.00</td>
                                            </tr> --}}
                                        {{-- </tbody> --}}
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <td>{{number_format($cart_total, 2)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table><a class="btn btn-primary btn-xl btn-block" href="{{route('web.checkout')}}">Proceed to checkout</a></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="block-space block-space--layout--before-footer"></div>
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
	@endsection
	
    @section('script')
    <script>
        function updateCart(quantity,cart_id){
            window.location.href = '{{url("user/cart/update/")}}'+"/"+cart_id+"/"+quantity;
        }
    </script>
	@endsection     