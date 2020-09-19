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
                        <div class="user-login-register bg-light">
                            <div class="login-register-title">
                                <h2 class="title">Login</h2>
                                <p class="desc">Great to have you back!</p>
                            </div>
                            <div class="login-register-form">
                                <form action="index.php">
                                    <div class="row ashia-mb-n50">
                                        <div class="col-12 ashia-mb-50">
                                            <label for="registerEmail">Email address <abbr class="required">*</abbr></label>
                                            <input type="email" placeholder="Username or email address">
                                        </div>
                                        <div class="col-12 ashia-mb-50">
                                            <label for="registerEmail">Confirm Password<abbr class="required">*</abbr></label>
                                            <input type="password" placeholder="Password"></div>
                                        <div class="col-12 text-center mb-2">
                                            <button class="btn btn-dark btn-outline-hover-dark">login</button>
                                        </div>
                                        <div class="col-12 ashia-mb-50">
                                            <a href="{{route('web.password.forgot-password')}}" class="fw-400">Lost your password?</a>
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
