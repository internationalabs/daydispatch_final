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

                <h2>Welcome</h2>

                <form action="{{ route('Auth.User') }}" method="POST" class="">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="UserEmail" placeholder="Email" required>
                        <span class="label-title"><i class='bx bx-user'></i></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="UserPassword" placeholder="Password" required>
                        <span class="label-title"><i class='bx bx-lock'></i></span>
                    </div>

                    <!--<div class="form-group col-sm-12 mb-2 p-0">-->
                    <!-- <div class="g-recaptcha" id="feedback-recaptcha"
                            data-sitekey="6LeJWF0pAAAAAEXVhIBI7rIpXsgBJ32HY2cd5BIV" required>
                        </div> -->
                    <!--</div>-->

                    <div class="form-group">
                        <div class="remember-forgot">
                            <label class="checkbox-box">Remember me
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>

                            <a href="{{ route('Forget.Password') }}" class="forgot-password">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" id="loginBtn" class="login-btn">Login Now</button>

                    <p class="mb-0">Don’t have an account? <a href="{{ route('Auth.New.User') }}">Sign Up</a></p>
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
