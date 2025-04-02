{{-- <form action="{{ route('Auth.Login.OTP') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <div class="form-group">
        <label for="otp">Enter OTP</label>
        <input type="text" class="form-control" name="otp_code" id="otp" required>
    </div>
    <button type="submit" class="btn btn-primary">Verify OTP</button>
</form> --}}
@extends('layouts.auth')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            zoom: 100% !important;
        }

        /*    iframe {*/
        /*    width: -webkit-fill-available;*/
        /*    height: -webkit-fill-available;*/
        /*}*/
        /*.g-recaptcha div {*/
        /*    width: 359px!important;*/
        /*    height: 122px!important;*/
        /*}*/
    </style>
    <!-- Start Login Area -->
    <div class="login-area bg-image">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="login-form position-relative">
                    <div class="logo">
                        <a href="{{ route('User.Dashboard') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}"
                                alt="image"></a>
                    </div>

                    <h2>Verify OTP</h2>

                    <form action="{{ route('Auth.Login.OTP') }}" method="POST" class="">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="UserEmail" value="{{ $UserEmail }}">
                        <input type="hidden" name="UserPassword" value="{{ $UserPassword }}">

                        <div class="form-group">
                            <input type="text" class="form-control" name="otp_code" placeholder="Enter OTP" required>
                            <span class="label-title"><i class='bx bx-key'></i></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="login-btn">Verify OTP</button>
                        </div>

                        <p class="mb-0">
                            Didn’t receive an OTP? <a
                                href="{{ route('Auth.Resend.OTP', ['user_id' => $user_id]) }}">Resend</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Area -->

    <script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('feedback-recaptcha', {
                'sitekey': '6LeJWF0pAAAAALczyEvEmbEnSxXlUCzaI62N6DW-'
            });
        };
        $("#loginBtn").click(function(e) {
            var response = grecaptcha.getResponse();
            $("#feedback-recaptcha").parent('.col-sm-12').siblings('.text-danger').remove();
            if (response.length == 0) {
                e.preventDefault();
                $("#feedback-recaptcha").parent('.col-sm-12').after(
                    '<div class="text-danger col-sm-12 p-0 mb-2">Please check recaptcha, if you are not a robot!</div>'
                );
            } else {
                console.log('Yes Checked');
            }
        })
    </script>
