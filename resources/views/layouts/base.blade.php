<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','سامانه مدیریت وظایف')</title>
    <link rel="stylesheet" href="{{asset('static/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/bs4.css')}}">
</head>
<body>
@include('include.alert')
@yield("body")
<script src="{{asset('static/js/jq3.2.1.js')}}"></script>
<script src="{{asset('static/js/bp.js')}}"></script>
</body>
</html>
