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
                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                @endif @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                            </div>
                            <div class="login-register-form">
                                <form action="{{route('web.register')}}" method="POST">
                                    @csrf
                                    <div class="row ashia-mb-n50">
                                        <div class="col-12 ashia-mb-20">
                                            <label for="username">Name <abbr class="required">*</abbr></label>
                                            <input type="text" value="{{old('username')}}" name ="username" id="username">
                                        </div>
                                        @if($errors->has('username'))
                                            <strong style="color:red" >{{ $errors->first('username') }}</strong>
                                        @enderror
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Email address <abbr class="required">*</abbr></label>
                                            <input type="email" value="{{old('email')}}" name="email" id="registerEmail">
                                        </div>
                                        @if($errors->has('email'))
                                            <strong style="color:red" >{{ $errors->first('email') }}</strong>
                                        @enderror
                                        <div class="col-12 ashia-mb-20">
                                            <label for="mobile">Mobile No <abbr class="required">*</abbr></label>
                                            <input type="tel" value="{{old('mobile')}}" name="mobile" id="mobile">
                                        </div>
                                        @if($errors->has('mobile'))
                                            <strong style="color:red" >{{ $errors->first('mobile') }}</strong>
                                        @enderror
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Password<abbr class="required">*</abbr></label>
                                            <input type="password"   name="password" id="registerEmail">
                                        </div>
                                        @if($errors->has('password'))
                                            <strong style="color:red" >{{ $errors->first('password') }}</strong>
                                        @enderror
                                        <div class="col-12 ashia-mb-20">
                                            <label for="registerEmail">Confirm Password<abbr class="required">*</abbr></label>
                                            <input type="password" name="password_confirmation" id="registerEmail">
                                        </div>
                                        @if($errors->has('password_confirmation'))
                                            <strong style="color:red" >{{ $errors->first('password_confirmation') }}</strong>
                                        @enderror
                                        <div class="col-12 text-center mb-2">
                                            <button class="btn btn-dark btn-outline-hover-dark">Register</button>
                                        </div>
                                        <div class="col-12 mb-5">
                                            <a href="{{route('web.login_form')}}" class="fw-400">if Already a Customer? Login</a>
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
