@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

  @section('content')
    <!-- Lost Password Section Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="lost-password">
                <p>Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
                <form action="confirm-password.php">
                    <div class="row ashia-mb-n30">
                        <div class="col-12 ashia-mb-30">
                            <label for="userName">Username or email</label>
                            <input id="userName" type="text">
                        </div>
                        <div class="col-12 text-center ashia-mb-30">
                            <button class="btn btn-dark btn-outline-hover-dark">reset password</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- Lost Password Section End -->
	@endsection
	
	@section('script')
	@endsection