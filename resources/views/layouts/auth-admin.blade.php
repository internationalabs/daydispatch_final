<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('admin-backend/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('admin-backend/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{ asset('admin-backend/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
    @livewireStyles

    <title>Day Dispatch - Transportation | Admin Authentication</title>

    <!-- JAVASCRIPT -->
    <!-- Layout config Js -->
    <script src="{{ asset('admin-backend/js/layout.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin-backend/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('admin-backend/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('admin-backend/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('admin-backend/js/pages/password-addon.init.js') }}"></script>
    <!-- validation init -->
    <script src="{{ asset('admin-backend/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ asset('admin-backend/js/pages/passowrd-create.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @livewireScripts

</head>

<body>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    {{ $slot }}
    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script>
                            Day Dispatch. Crafted with <i class="mdi mdi-heart text-danger"></i> by DayDispatch Team.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

@if (Session::has('Success!'))
    <script>
        toastr.success("{!! Session::get('Success!') !!}");
    </script>
@endif
@if (Session::has('Error!'))
    <script>
        toastr.error("{!! Session::get('Error!') !!}");
    </script>
@endif

<script>
    $(document).ready(function () {
        $(document).on('focus', ':input', function () {
            $(this).attr('autocomplete', 'off');
        });

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            const ASCIICode = evt.which ? evt.which : evt.keyCode;
            return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
        }

        $("form").delegate(".phone-number", "focus", function () {
            var selectionStart = $('input')[0].selectionStart;
            var selectionEnd = $('input')[0].selectionEnd;
            $(".phone-number")[0].setSelectionRange(selectionStart, selectionEnd);
            $(".phone-number").mask("(999) 999-9999");
        });
    });
</script>
</body>

</html>
