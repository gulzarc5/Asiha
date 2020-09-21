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
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Profile</span></li>
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
		                            <li class="account-nav__item account-nav__item--active"><a href="{{route('web.profile.profile')}}">Profile</a></li>
		                            <li class="account-nav__item"><a href="{{route('web.order.order')}}">Order History</a></li>
		                            <li class="account-nav__item"><a href="{{route('web.address.address')}}">Addresses</a></li>
		                            <li class="account-nav__item"><a href="{{route('web.password.change-password')}}">Password</a></li>
		                            <li class="account-nav__divider" role="presentation"></li>
		                            <li class="account-nav__item"><a href="account-login.html">Logout</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="col-12 col-lg-9 mt-4 mt-lg-0">
		                    <div class="dashboard">
		                        <div class="dashboard__profile card profile-card">
		                            <div class="card-body profile-card__body">
		                                <div class="profile-card__avatar"><img src="{{asset('web/images/avatars/avatar-4.jpg')}}" alt=""></div>
		                                <div class="profile-card__name">Helena Garcia</div>
		                                <div class="profile-card__email">red-parts@example.com</div>
		                                <div class="profile-card__edit">
											<form>
												<div class="form-group">
													<label for="checkout-first-name">Change Image</label>
													<input type="file" class="form-control" id="checkout-first-name" placeholder="First Name">
												</div>
											</form>
										</div>
		                            </div>
		                        </div>
		                        <div class="dashboard__address card address-card address-card--featured">
		                            <div class="address-card__badge tag-badge tag-badge--theme">Default</div>
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
		                                <div class="address-card__footer"><a href="{{route('web.address.edit-address')}}">Edit Address</a></div>
		                            </div>
		                        </div>
		                        <div class="dashboard__orders card card-body--padding--2">
		                            <div class="card-title">
		                                <h5>Edit Profile</h5>
		                            </div>
		                            <div class="card-table">
		                                <form>
	                                        <div class="form-group">
	                                            <label for="checkout-first-name">First Name</label>
	                                            <input type="text" class="form-control" id="checkout-first-name" placeholder="First Name">
	                                        </div>
	                                        <div class="form-row">
	                                            <div class="form-group col-md-6">
	                                                <label for="checkout-email">Email address</label>
	                                                <input type="email" class="form-control" id="checkout-email" placeholder="Email address">
	                                            </div>
	                                            <div class="form-group col-md-6">
	                                                <label for="checkout-phone">Phone</label>
	                                                <input type="text" class="form-control" id="checkout-phone" placeholder="Phone">
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="checkout-address">Address </label>
	                                            <textarea id="checkout-comment" class="form-control" rows="4"></textarea>
	                                        </div>
	                                        <div class="form-row">
	                                            <div class="form-group col-md-6">
	                                                <label for="checkout-city">Town / City</label>
	                                                <input type="text" class="form-control" id="checkout-city">
	                                            </div>
	                                            <div class="form-group col-md-6">
	                                                <label for="checkout-postcode">Postcode / ZIP</label>
	                                                <input type="text" class="form-control" id="checkout-postcode">
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <button type="button" class="btn btn-secondary btn-lg">Cancel</button>
	                                            <button type="button" class="btn btn-primary btn-lg">Submit</button>
	                                        </div>
	                                    </form>
		                            </div>
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