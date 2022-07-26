@extends('layouts.index')

@push('title')
    <title>Login</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU - Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">Please enter your login credentials below.</p>

            <br>

        	<form class="login-form" method="POST">

                <div class="form-control">
                    <input type="text" placeholder="Email or SR-Code" name="userid">
                </div>

                <div class="form-control">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>

                <div class="form-control non-input">
                	<a class="forgotPassword" href="recover">Forgot Password</a>
                </div>


                <!-- <div class="form-control reCaptcha">
                    <div id="g-recaptcha" class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" data-sitekey="6LcasJsgAAAAADf5Toas_DlBccLh5wyGIzmDmjQi"></div>
                </div> -->

                <br>
                
                <button class="submit btn btn-secondary">Login</button>
            </form>

            <p> Don't have an account? Sign Up <a href="registration">here</a> <p>
        </div>
	</section>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.showpassword').click(function(){            
                let input = $('#password');
                if(input.attr('type') === 'password'){
                    input.attr('type','text');
                    $('.showpassword').removeClass('fa-eye-slash');
                    $('.showpassword').addClass('fa-eye');
                }
                else{
                    input.attr('type','password');
                    $('.showpassword').removeClass('fa-eye');
                    $('.showpassword').addClass('fa-eye-slash');
                }
            });
        });
    </script>
@endpush