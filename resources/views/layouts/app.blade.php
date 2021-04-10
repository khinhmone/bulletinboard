<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>KK Shop</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('../bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @if (Auth::guest())
                    <a class="navbar-brand" href="{{ URL::to('/') }}"> KK Shop </a>
                        <!-- {{ config('app.name', 'Laravel') }} -->                        
                    @else
                    <a class="navbar-brand" href="{{ URL::to('/home') }}"> KK Shop </a>
                    @endif

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())  <!-- before login -->
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>     Login</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>    Register</a></li>
                            

                        @else <!-- when finished login -->                           

                            @if( Auth::user()->type == 0 )
                                <li class="dropdown">
                                    <a href="{{ URL::to('/home') }}"> <span class="glyphicon glyphicon-home"></span>                               
                                      Home 
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>                                   
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="{{ URL::to('/order_history') }}"> <span class="glyphicon glyphicon-th-list"></span>                               
                                      Order History 
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>                                           
                                            <form id="logout-form" action="" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                       <span class="glyphicon glyphicon-cog"></span>     Setting <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/member/user/'.Auth::user()->id.'/edit')}}">
                                                Update Profile
                                            </a>

                                            <form id="logout-form" action="" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>                              
                            

                            @else( Auth::user()->type == 1 )
                                <li><a href="{{ URL::to('/home') }}"> <span class="glyphicon glyphicon-home"></span>    Home</a></li>
                                <!-- <li><a href="{{ URL::to('/admin/list') }}" > Product List </a></li> -->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Product <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/admin/list') }}">
                                                Product List
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ URL::to('/admin/product/create') }}">
                                                Add Product
                                            </a>                                            
                                        </li>

                                        <li>
                                            <a href="{{ URL::to('/admin/restoreproduct') }}">
                                                Restore Product 
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Category <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/admin/category/create') }}">
                                                Add Category
                                            </a>                                            
                                        </li>

                                        <li>
                                            <a href="{{ URL::to('/admin/restorecategory') }}">
                                                Restore Category 
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>  
                                            User <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/admin/userlist') }}">
                                              View User List</a>
                                        </li>                                        
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Order <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/admin/admin_orderlist') }}">
                                                View Order List</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('/order_history') }}">                                    
                                                Order History 
                                            </a>                                    
                                        </li>                                   
                                    </ul>
                                </li>                   

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span>  
                                        Setting <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ URL::to('/admin/admin/'.Auth::user()->id.'/edit')}}">
                                                Update Profile
                                            </a>                                            
                                        </li>
                                    </ul>
                                </li>

                            @endif
                            <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
