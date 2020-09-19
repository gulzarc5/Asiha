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
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Checkout</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="checkout block">
                <div class="container-fluid">
                    <span id="checkout_div">
                        <form class="row" action="{{route('web.order_place')}}" method="post">
                            @csrf
                            <div class="col-12 col-lg-8 col-xl-8">
                                <div class="card mb-lg-0">
                                    <div class="card-body card-body--padding--2">
                                        <h3 class="card-title">Select Shipping Address 
                                            <button type="button" class="btn btn-primary" style="float: right;margin-top: -6px;" onclick="showDiv()"><i class="fa fa-plus"></i> Add Address</button>
                                        </h3>
                                        <div class="addresses-list">
                                            @if (isset($address) && !empty($address))
                                            @php
                                                $address_count = true;
                                            @endphp
                                                @foreach ($address as $item)
                                                <div class="addresses-list__item card address-card">
                                                    <label class="address-list__item-header">
                                                        <span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="address_id" type="radio" {{$address_count ? 'checked':''}}> <span class="input-radio__circle"></span></span></span>
                                                    </label>
                                                    <div class="address-card__body">
                                                        <div class="address-card__name">{{$item->name}}</div>
                                                        <div class="address-card__row">{{$item->address}}<br>{{$item->city}},{{$item->state}}-{{$item->pin}}</div>
                                                        <div class="address-card__row">
                                                            <div class="address-card__row-title">Phone Number</div>
                                                            <div class="address-card__row-content">{{$item->mobile}}</div>
                                                        </div>
                                                        <div class="address-card__row">
                                                            <div class="address-card__row-title">Email Address</div>
                                                            <div class="address-card__row-content">{{$item->email}}</div>
                                                        </div>
                                                        {{-- <div class="address-card__footer"><a href="#">Edit</a>&nbsp;&nbsp; <a href="#">Remove</a></div> --}}
                                                    </div>
                                                </div><div class="addresses-list__divider"></div>
                                                @php
                                                    $address_count = false;
                                                @endphp
                                                @endforeach
                                            @endif
                                            

                                            {{-- <div class="addresses-list__item card address-card">
                                                <label class="address-list__item-header">
                                                    <span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_address_method" type="radio" checked="checked"> <span class="input-radio__circle"></span></span></span>
                                                </label>
                                                <div class="address-card__body">
                                                    <div class="address-card__name">Helena Garcia</div>
                                                    <div class="address-card__row">Random Federation
                                                        <br>115302, Moscow
                                                        <br>ul. Varshavskaya, 15-2-178</div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Phone Number</div>
                                                        <div class="address-card__row-content">38 972 588-42-36</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Email Address</div>
                                                        <div class="address-card__row-content">helena@example.com</div>
                                                    </div>
                                                    <div class="address-card__footer"><a href="#">Edit</a>&nbsp;&nbsp; <a href="#">Remove</a></div>
                                                </div>
                                            </div><div class="addresses-list__divider"></div>

                                            <div class="addresses-list__item card address-card">
                                                <label class="address-list__item-header">
                                                    <span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_address_method" type="radio"> <span class="input-radio__circle"></span></span></span>
                                                </label>
                                                <div class="address-card__body">
                                                    <div class="address-card__name">Jupiter Saturnov</div>
                                                    <div class="address-card__row">RandomLand
                                                        <br>4b4f53, MarsGrad
                                                        <br>Sun Orbit, 43.3241-85.239</div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Phone Number</div>
                                                        <div class="address-card__row-content">ZX 971 972-57-26</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Email Address</div>
                                                        <div class="address-card__row-content">jupiter@example.com</div>
                                                    </div>
                                                    <div class="address-card__footer"><a href="#">Edit</a>&nbsp;&nbsp; <a href="#">Remove</a></div>
                                                </div>
                                            </div><div class="addresses-list__divider"></div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-xl-4 mt-4 mt-lg-0">
                                <div class="card mb-0">
                                    <div class="card-body card-body--padding--2">
                                        <h3 class="card-title">Your Order</h3>
                                        <table class="checkout__totals">
                                            {{-- <tbody class="checkout__totals-subtotals">
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>$5877.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td>$25.00</td>
                                                </tr>
                                            </tbody> --}}
                                            <tfoot class="checkout__totals-footer">
                                                <tr>
                                                    <th>Cart Total</th>
                                                    <td>Rs. {{number_format($cart_total, 2)}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="checkout__payment-methods payment-methods">
                                            <ul class="payment-methods__list">
                                                {{-- <li class="payment-methods__item payment-methods__item--active">
                                                    <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_method" type="radio" checked="checked" value="2"> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">Online transfer</span></label>
                                                    <div class="payment-methods__item-container">
                                                        <div class="payment-methods__item-details text-muted">Make your payment directly into our bank account. Please use our payment gateway.</div>
                                                    </div>
                                                </li> --}}
                                                <li class="payment-methods__item">
                                                    <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_method" type="radio" value="3" checked> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">Cash on delivery</span></label>
                                                    <div class="payment-methods__item-container">
                                                        <div class="payment-methods__item-details text-muted">Pay with cash upon delivery.</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-xl btn-block">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </span>


                    <span id="address_div" style="display: none">
                            <div class="col-12 col-lg-8 col-xl-8">
                                <div class="card mb-lg-0">
                                    <div class="card-body card-body--padding--2">
                                        <h3 class="card-title">Add Shipping Address</h3>
                                        <form method="post" action="{{route('web.shipping_add')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="checkout-first-name"> Name</label>
                                                <input type="text" class="form-control" id="checkout-first-name" placeholder="Enter Name" name="name" required>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="checkout-email">Email address</label>
                                                    <input type="email" class="form-control" id="checkout-email" placeholder="Email address" name="email" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="checkout-phone">Phone</label>
                                                    <input type="text" class="form-control" id="checkout-phone" placeholder="Phone" name="mobile" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="checkout-address">Address </label>
                                                <textarea id="checkout-comment" class="form-control" rows="4" name="address"></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="checkout-city">State</label>
                                                    <input type="text" class="form-control" id="checkout-city" name="state" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="checkout-city">Town / City</label>
                                                    <input type="text" class="form-control" id="checkout-city" name="city" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="checkout-postcode">Postcode / ZIP</label>
                                                    <input type="text" class="form-control" id="checkout-postcode" name="pin" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-secondary btn-lg" onclick="hideDiv()">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </span>
                </div>
            </div>
            <div class="block-space block-space--layout--before-footer"></div>
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
	@endsection
	
    @section('script')
        <script>

            function showDiv(){            
                $("#address_div").show();
                $("#checkout_div").hide();
            }

            function hideDiv(){
                $("#address_div").hide();
                $("#checkout_div").show();
            }
        </script>
	@endsection