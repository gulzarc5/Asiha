@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
    <!-- site__header / end -->
		<!-- site__body -->
		<div class="site__body">
		    <div class="block-space block-space--layout--spaceship-ledge-height"></div>
		    <div class="block">
		        <div class="container">
		            <div class="not-found">
		                <div class="not-found__404">Order Placed</div>
		                <div class="not-found__content">
		                    <p class="not-found__text">Your Order is successfully Placed
		                        <br><a class="btn btn-secondary btn-sm" href="{{route('web.order.order')}}">Check order</a></p>
		                    <p class="not-found__text">Or go to .</p><a class="btn btn-secondary btn-sm" href="{{route('web.index')}}">Go To Home Page</a></div>
		            </div>
		        </div>
		    </div>
		    <div class="block-space block-space--layout--before-footer"></div>
		</div>
		<!-- site__body / end -->
	<!-- site__footer / end -->
	@endsection
	
	@section('script')
	@endsection
        