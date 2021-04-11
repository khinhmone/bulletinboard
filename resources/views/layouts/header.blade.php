<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SCM Bulletin Board</title>

    <!-- Styles -->
    <link href="{{ URL::asset('../bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('../bootstrap-5/css/bootstrap.css') }}" rel="stylesheet">

    <!-- <script type="text/javascript" src="{{ URL::asset('../bootstrap/js/bootstrap.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ URL::asset('../bootstrap-5/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <h2><a class="navbar-brand" href="#">SCM Bulletin Board</a></h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if(Auth::user()->id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="/users">Users</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/user_profile">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">Posts</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/logout') }}">Logout</a>
                        </li>
                    </ul>
                </form>
            </div>
        </nav>
    </div>
</body>
</html>
