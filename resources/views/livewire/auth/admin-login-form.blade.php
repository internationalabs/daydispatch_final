<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- auth page content -->
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="{{ route('Frontend.index') }}" class="d-inline-block auth-logo">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="20">
                        </a>
                    </div>
                    <p class="mt-3 fs-15 fw-medium">Day Dispatch | Admin Portal</p>
                    <a class="mt-3 fs-15 fw-medium text-white" href="{{ route('Auth.Agent.Forms') }}">Agent Login</a>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Welcome Back!</h5>
                            <p class="text-muted">Sign in to continue to Day Dispatch.</p>
                        </div>
                        <div class="p-2 mt-4">
                            @if (session('flash_message'))
                                <div class="alert alert-success">
                                    {{ session('flash_message') }}
                                </div>
                            @endif
                            <form action="{{ route('Auth.Admin') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="username" name="UserEmail"
                                        placeholder="Email Address" required>
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="float-end">
                                        <a href="JavaScript:void(0);" class="text-muted">Forgot password?</a>
                                    </div>
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" class="form-control pe-5" name="UserPassword"
                                            placeholder="Enter Password" required id="password-input">
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>

                                <!--<div class="form-group col-sm-12 mb-2 p-0">-->
{{--                                <div class="g-recaptcha" id="feedback-recaptcha"--}}
{{--                                    data-sitekey="6LeJWF0pAAAAAEXVhIBI7rIpXsgBJ32HY2cd5BIV" required>--}}
{{--                                </div>--}}
                                <!--</div>-->

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="auth-remember-check">
                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                </div>

                                <div class="mt-4">
                                    <button id="loginBtn" class="btn btn-success w-100" type="submit">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">Don't have an account ? <a href="{{ route('Auth.New.Admin') }}"
                            class="fw-semibold text-primary text-decoration-underline">
                            Signup </a></p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end auth page content -->



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
