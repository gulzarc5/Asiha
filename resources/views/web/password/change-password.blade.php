@extends('web.templet.master')

    @section('head')
        <meta name="description" content="description">
    @endsection

    @section('content')
        <!-- Lost Password Section Start -->
        <div class="section section-padding">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 mx-auto">
                        <div class="user-login-register  bg-light">
                            <div class="login-register-title">
                                <h2 class="title">Change Password</h2>
                                <p class="desc">Set your new password and reactivate your account</p>
                            </div>
                            <div class="login-register-form">
                                <form action="index.php">
                                    <div class="row ashia-mb-n50">
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Password<abbr class="required">*</abbr></label>
                                            <input type="password" id="registerEmail">
                                        </div>
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Confirm Password<abbr class="required">*</abbr></label>
                                            <input type="password" id="registerEmail">
                                        </div>
                                        <div class="col-12 text-center mb-5">
                                            <button class="btn btn-dark btn-outline-hover-dark">Proceed</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lost Password Section End -->
	@endsection
	
	@section('script')
	@endsection