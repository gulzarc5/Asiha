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
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">New Password</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="container container-lg">
                    <div class="row">
                        <div class="col-md-8 d-flex" style="margin: 0 auto">
                            <div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
                                <div class="card-body card-body--padding--2">
                                    <h3 class="card-title">New Password</h3>
                                    <form>
                                        <div class="form-group">
                                            <label for="signup-password">New Password</label>
                                            <input id="signup-password" type="password" class="form-control" placeholder="Secret word">
                                        </div>
                                        <div class="form-group">
                                            <label for="signup-confirm">Repeat New password</label>
                                            <input id="signup-confirm" type="password" class="form-control" placeholder="Secret word">
                                        </div>
                                        <div class="form-group mb-0"> 
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </div>
                                    </form>
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