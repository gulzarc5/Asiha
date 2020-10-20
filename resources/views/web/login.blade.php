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
                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                @endif @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                                @if (session()->has('login_error'))
			                        <div class="alert alert-danger">{{ Session::get('login_error') }}</div>
			                    @endif
                            </div>
                            <div class="login-register-form">
                                <form action="{{route('web.login')}}" method="POST">
                                    @csrf
                                    <div class="row ashia-mb-n50">
                                        <div class="col-12 ashia-mb-50">
                                            <label for="registerEmail">Email address <abbr class="required">*</abbr></label>
                                            <input type="text" name="email" value ="{{old('email')}}" placeholder="Mobile or email address">
                                        </div>
                                        @if($errors->has('email'))
                                            <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                        @enderror
                                        <div class="col-12 ashia-mb-50">
                                            <label for="registerEmail">Confirm Password<abbr class="required">*</abbr></label>
                                            <input type="password" name="password" placeholder="Password">
                                        </div>
                                        @if($errors->has('password'))
                                            <strong style="color:red" >{{ $errors->first('password') }}</strong>
                                        @enderror
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
