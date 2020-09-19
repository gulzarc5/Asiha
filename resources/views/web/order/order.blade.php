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
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Order History</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-3 d-flex">
                            <div class="account-nav flex-grow-1">
                                <h4 class="account-nav__title">Navigation</h4>
                                <ul class="account-nav__list">
		                            <li class="account-nav__item"><a href="{{route('web.profile.profile')}}">Profile</a></li>
		                            <li class="account-nav__item account-nav__item--active"><a href="{{route('web.order.order')}}">Order History</a></li>
		                            <li class="account-nav__item"><a href="{{route('web.address.address')}}">Addresses</a></li>
		                            <li class="account-nav__item"><a href="{{route('web.password.change-password')}}">Password</a></li>
		                            <li class="account-nav__divider" role="presentation"></li>
		                            <li class="account-nav__item"><a href="account-login.html">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                            <div class="dashboard">
                                <div class="dashboard__orders card mt-0">
                                    <div class="card-header">
                                        <h5>Order History</h5>
                                    </div>
                                    <div class="card-divider"></div>
                                    <table class="cart-table__table">
                                        <thead class="cart-table__head">
                                            <tr class="cart-table__row">
                                                <th class="cart-table__column cart-table__column--image">Image</th>
                                                <th class="cart-table__column cart-table__column--product">Product</th>
                                                <th class="cart-table__column cart-table__column--price">Price</th>
                                                <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                                                <th class="cart-table__column cart-table__column--total">Total</th>
                                                <th class="cart-table__column cart-table__column--remove" style="text-align: center;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="cart-table__body">
                                            <tr class="cart-table__row">
                                                <td class="cart-table__column cart-table__column--image">
                                                    <a href="#"><img src="{{asset('web/images/products/4a.jpg')}}" alt=""></a>
                                                </td>
                                                <td class="cart-table__column cart-table__column--product"><a href="#" class="cart-table__product-name">Glossy Gray 19" Aluminium Wheel AR-19</a>
                                                    <ul class="cart-table__options">
                                                        <li>Order ID: 2DFS2545945GDA</li>
                                                        <li>Order Date: 20-07-20</li>
                                                    </ul>
                                                </td>
                                                <td class="cart-table__column cart-table__column--price" data-title="Price">$699.00</td>
                                                <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">2</td>
                                                <td class="cart-table__column cart-table__column--total" data-title="Total">$1398.00</td>
                                                <td class="cart-table__column cart-table__column--remove">
                                                    <div class="status-badge status-badge--style--success status-badge--has-text"><div class="status-badge__body"><div class="status-badge__text">In Stock</div><div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="In Stock"></div></div></div>
                                                </td>
                                            </tr>
                                            <tr class="cart-table__row">
                                                <td class="cart-table__column cart-table__column--image">
                                                    <a href="#"><img src="{{asset('web/images/products/2a.jpg')}}" alt=""></a>
                                                </td>
                                                <td class="cart-table__column cart-table__column--product"><a href="#" class="cart-table__product-name">Brandix Brake Kit BDX-750Z370-S</a>
                                                    <ul class="cart-table__options">
                                                        <li>Order ID: 2DFS2545945GDA</li>
                                                        <li>Order Date: 20-07-20</li>
                                                    </ul>
                                                </td>
                                                <td class="cart-table__column cart-table__column--price" data-title="Price">$849.00</td>
                                                <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">2</td>
                                                <td class="cart-table__column cart-table__column--total" data-title="Total">$849.00</td>
                                                <td class="cart-table__column cart-table__column--remove">
                                                   <div class="status-badge status-badge--style--failure status-badge--has-text"><div class="status-badge__body"><div class="status-badge__text">Cancelled</div><div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="In Stock"></div></div></div> 
                                                </td>
                                            </tr>
                                            <tr class="cart-table__row">
                                                <td class="cart-table__column cart-table__column--image">
                                                    <a href="#"><img src="{{asset('web/images/products/3a.jpg')}}" alt=""></a>
                                                </td>
                                                <td class="cart-table__column cart-table__column--product"><a href="#" class="cart-table__product-name">Twin Exhaust Pipe From Brandix Z54</a>
                                                    <ul class="cart-table__options">
                                                        <li>Order ID: 2DFS2545945GDA</li>
                                                        <li>Order Date: 20-07-20</li>
                                                    </ul>
                                                </td>
                                                <td class="cart-table__column cart-table__column--price" data-title="Price">$1210.00</td>
                                                <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">2</td>
                                                <td class="cart-table__column cart-table__column--total" data-title="Total">$3630.00</td>
                                                <td class="cart-table__column cart-table__column--remove">
                                                    <div class="status-badge status-badge--style--warning status-badge--has-text"><div class="status-badge__body"><div class="status-badge__text">In Transit</div><div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="In Stock"></div></div></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-space block-space--layout--before-footer"></div>
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
	@endsection
	
	@section('script')
	@endsection