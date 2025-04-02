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

    <title>Day Dispatch - Transportation | Agent Authentication</title>

    <!-- JAVASCRIPT -->
    <!-- Layout config Js -->
    <script src="{{ asset('admin-backend/js/layout.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin-backend/js/plugins.js') }}"></script>

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

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="{{ route('Frontend.index') }}" class="d-block">
                                                <img src="{{ asset('backend/img/small-logo.png') }}" alt="" height="18">
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div>

                                            <div id="qoutescarouselIndicators" class="carousel slide"
                                                 data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                            easy for customization. Thanks very much! "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" The theme is really great with an
                                                            amazing customer support."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                            easy for customization. Thanks very much! "</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            {{ $slot }}

                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy;
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
            var ASCIICode = evt.which ? evt.which : evt.keyCode;
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
