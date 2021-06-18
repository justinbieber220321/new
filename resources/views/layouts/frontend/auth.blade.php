<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo1.png') }}">
    <title>{{ getEnvX('SITE_TITLE') }}</title>

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap-creative.min.css') }}" id="bs-default-stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/app-creative.min.css') }}" id="app-default-stylesheet"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap-creative-dark.min.css') }}" id="bs-dark-stylesheet" disabled/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/app-creative-dark.min.css') }}" id="app-dark-stylesheet"  disabled/>

    <!-- icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/icons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/vendor/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/common.css') }}">

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('frontend/vendor/jquery3.5/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/loadingoverlay/loadingoverlay.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/common.js') }}"></script>
</body>
</html>