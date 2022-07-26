@extends('layouts.index')

@push('title')
    <title>Registration</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ url('css/registration.css') }}">
@endpush

@section('content')
    <section class="main">
		<div class="registration-container">
			<p class="title">BatStateU - Health Portal</p>
        	<p class="separator"></p>
        	<p class="welcome-message">Enter your "Gsuite email" and OTP below.</p>
        	<form class="registration-form" method="POST" action="{{ url('registration/register') }}">
                <div class="form-section">
                    @csrf
                    <div class="form-control">
                        <input type="text" placeholder="Gsuite email" id="gsuite_email" name="gsuite_email"  value="{{ old('gsuite_email') }}"> 
                    </div>
                    
                    <div id="gsuite_email_error" class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('gsuite_email')
                        {{ $message }}
                    @enderror
                    </div>

                    <div class="form-control">
                        <input type="number" placeholder="One Time Pin" id="otp" name="otp"  value="{{ old('otp') }}">
                        <button id="btn_otp" class="btn btn-secondary">
                            <i class="lbl_loading fa-solid fa-spinner d-none"></i>
                            <span id="btn_otp_lbl">Send</span>
                        </button>          
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('otp')
                        {{ $message }}
                    @enderror
                    </div>
                    

                    <div class="form-control">
                        <input type="password" placeholder="Password" id="password" name="password">
                        <span class="showpassword fa-regular fa-eye-slash"></span>                               
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('password')
                        {{ $message }}
                    @enderror
                    </div>

                    <div class="form-control">
                        <input type="password" placeholder="Confirm New Password" id="cpassword" name="cpassword">   
                        <span class="showpassword fa-regular fa-eye-slash"></span>     
                    </div>
                    
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('cpassword')
                        {{ $message }}
                    @enderror
                    </div>
                    

                    <!-- <div class="form-control reCaptcha">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" data-sitekey="6LcasJsgAAAAADf5Toas_DlBccLh5wyGIzmDmjQi"></div>
                    </div> -->
                </div>

                <button id="btnProceed " class="submit btn btn-secondary" style="float: right;">Register</button>     
                
            </form>

            <p>Already have an account?  Login <a href="/">here</a> <p>
        </div>
	</section>

@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.showpassword').click(function(){
                $('.showpassword').toggleClass('fa fa-eye-slash');
                let input_pass = $('#password, #cpassword');
                if(input_pass.attr('type') === 'password'){
                    input_pass.attr('type','text');
                    $('.showpassword').removeClass('fa-eye-slash');
                    $('.showpassword').addClass('fa-eye');
                }
                else{
                    input_pass.attr('type','password');
                    $('.showpassword').removeClass('fa-eye');
                    $('.showpassword').addClass('fa-eye-slash');
                }
            });

            $('#btn_otp').click(function(e){
                e.preventDefault();
                let gsuite_email = $('#gsuite_email').val();

                $('.lbl_loading').removeClass('d-none');
                $('#btn_otp_lbl').addClass('d-none');

                $.ajax({
                    type: "POST",
                    url: "{{ url('registration/send_otp') }}",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "gsuite_email": gsuite_email,
                        "msg_type": "register",
                        "_token": "{{csrf_token()}}",
                    }),
                    success: function(response){
                        console.log(response);
                        $('.lbl_loading').addClass('d-none');
                        $('#btn_otp_lbl').removeClass('d-none');

                        if(response.status == 400){
                            $.each(response.errors, function(key, err_values){
                                $('#'+key+'_error').html(err_values);
                            });
                        }
                        else{
                            $('.error-message').html('');
                            swal(response.title, response.message, response.icon);
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush