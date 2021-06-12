<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]><meta http-equiv="cleartype" content="on"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0" id="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" type="image/png" href="#"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&amp;display=swap" rel="stylesheet">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/password.css') }}">

    <style>
        .link {
            color: #3b5998;
            text-decoration: none;
            display: block;
            border-collapse: collapse;
            border-radius: 6px;
            text-align: center;
            display: block;
            border: none;
            background: #1877f2;
            padding: 6px 20px 10px 20px;
        }
    </style>
</head>
<body>
<div style="margin: 15px 0">Hi, {{$name}}</div>

<p>
    We have received your password reset request.
    <br>
    You can change your password directly <a href="{{$link}}"> here</a>
</p>

</body>
</html>

