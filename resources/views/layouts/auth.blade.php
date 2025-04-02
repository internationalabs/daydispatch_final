<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datatables.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}"> --}}

    <title>Day Dispatch - Transportation | User Portal</title>

    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Vendors Min JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    {{-- <script src="{{ asset('backend/js/vendors.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatable.custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function zoom() {
            document.body.style.zoom = "85%"
        }
    </script>
    <style>
        body{
            zoom: 85%;
        }
    </style>
</head>

<body>

    {{ $slot }}

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
        $(document).ready(function() {
            $(document).on('focus', ':input', function() {
                $(this).attr('autocomplete', 'off');
            });

            function onlyNumberKey(evt) {
                // Only ASCII character in that range allowed
                var ASCIICode = evt.which ? evt.which : evt.keyCode;
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                    return false;
                }
                return true;
            }

            $("form").delegate(".phone-number", "focus", function() {
                var selectionStart = $('input')[0].selectionStart;
                var selectionEnd = $('input')[0].selectionEnd;
                $(".phone-number")[0].setSelectionRange(selectionStart, selectionEnd);
                $(".phone-number").mask("(999) 999-9999");
            });
        });
    </script>
</body>

</html>
