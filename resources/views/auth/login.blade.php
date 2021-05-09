<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SCM Bulletin Board</title>

    <link href="{{ URL::asset('../bootstrap-5/css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css">
        span, li{
            color: red;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<i><h2 style="color: gray;margin: 20px 0 20px 338px;">SCM Bulletin Board</h2></i>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login Form</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/user/login') }}">
                {{ csrf_field() }}

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-center">Email :</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="email" autofocus>
                  </div>
                  <div class="col-md-2 text-md-left">
                    <span>*</span>
                  </div>
                </div><br>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-center">Password :</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-md-2 text-md-left">
                        <span>*</span>
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-center"></label>
                    <div class="col-md-6">
                        <input type="checkbox" name="remember_me"> Remember Me
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-center"></label>
                    <div class="col-md-6">
                        <a style="text-decoration: none;" href="{{ URL::to('/forget_password') }}">Forget password?</a>
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-center"></label>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>

                
            </form>
          </div>
      </div>
    </div>
  </div>
</div>


