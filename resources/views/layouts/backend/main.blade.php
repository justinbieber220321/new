<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/image/favicon.png') }}">
    <title>System-rps.com – RPS</title>

    {{--<meta name="description" content="@yield('description')">--}}
    {{--<meta name="keywords" content="@yield('keywords')">--}}

    <meta name="description" content="{{ getSiteMetaTitle() }}">
    <meta name="keywords" content="{{ getSiteMetaDescription() }}">
    <meta name="phone" content="{{ getSitePhone() }}">

    <link href="/backend/css/theme/style.min.css" rel="stylesheet">
    <link href="/backend/vendor/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/backend/vendor/quill/dist/quill.snow.css" rel="stylesheet">
    <link href="/backend/vendor/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/backend/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    @stack('vendor_css')

    <link href="/backend/css/theme/common.css" rel="stylesheet">
    <link href="{{ asset('backend/css/common.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body  stype="padding-bottom: 0px !important" >
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('layouts.backend.structures._topbar')
        @include('layouts.backend.structures._left-sidebar')
        <div class="page-wrapper">
            @yield('content')
        </div>
        @include('layouts.backend.structures._modal')
    </div>

    <script src="/backend/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/backend/vendor/jquery-ui/jquery-ui.js"></script>
    <script src="/backend/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="/backend/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/backend/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/backend/js/theme/waves.js"></script>
    <script src="/backend/js/theme/sidebarmenu.js"></script>
    <script src="/backend/js/theme/custom.min.js"></script>
    <script src="/backend/vendor/flot/excanvas.js"></script>
    <script src="/backend/vendor/flot/jquery.flot.js"></script>
    <script src="/backend/vendor/flot/jquery.flot.pie.js"></script>
    <script src="/backend/vendor/flot/jquery.flot.time.js"></script>
    <script src="/backend/vendor/flot/jquery.flot.stack.js"></script>
    <script src="/backend/vendor/flot/jquery.flot.crosshair.js"></script>
    <script src="/backend/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="/backend/vendor/loadingoverlay/loadingoverlay.min.js"></script>
    <script src="/backend/vendor/tinymce/tinymce.min.js"></script>
    <script src="/backend/vendor/select2/dist/js/select2.min.js"></script>
    <script src="/backend/vendor/quill/dist/quill.min.js"></script>
    <script src="/backend/vendor/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="/backend/vendor/mask/jquery.inputmask.bundle.min.js"></script>
    <script src="/backend/vendor/mask/mask.init.js"></script>
    <script src="/backend/vendor/jquery_maxlength/jquery.maxlength.js"></script>

    <script src="/backend/js/common.js"></script>

    @stack('script')

</body>

</html>
