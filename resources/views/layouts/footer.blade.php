<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ URL::asset('../bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('../bootstrap-5/css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css">
        #copyright{
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 35px;
            background-color: lightgrey;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <div id="copyright">© Copyright 2021 Partner Company</div>
    </div>
</body>
</html>
