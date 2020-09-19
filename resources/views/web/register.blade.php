@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
        <!-- Login & Register Section Start -->
        <div class="section section-padding">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 mx-auto">
                        <div class="user-login-register  bg-light">
                            <div class="login-register-title">
                                <h2 class="title">Register</h2>
                                <p class="desc">If you don’t have an account, register now!</p>
                            </div>
                            <div class="login-register-form">
                                <form action="#">
                                    <div class="row ashia-mb-n50">
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Email address <abbr class="required">*</abbr></label>
                                            <input type="email" id="registerEmail">
                                        </div>
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Password<abbr class="required">*</abbr></label>
                                            <input type="password" id="registerEmail">
                                        </div>
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Confirm Password<abbr class="required">*</abbr></label>
                                            <input type="password" id="registerEmail">
                                        </div>
                                        <div class="col-12 text-center mb-2">
                                            <button class="btn btn-dark btn-outline-hover-dark">Register</button>
                                        </div>
                                        <div class="col-12 mb-5">
                                            <a href="login.php" class="fw-400">if Already a Customer? Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login & Register Section End -->
@endsection

@section('script')

@endsection
