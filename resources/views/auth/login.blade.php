<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SCM Bulletin Board</title>

    <link href="{{ URL::asset('../css/login_form/login_form.css') }}" rel="stylesheet">
</head>
<body>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)            
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ URL::to('/login') }}">
        {{ csrf_field() }}
        <div>
            <table>
                <tr>
                   <th>SCM Bulletin Board</th>
                </tr>

                <tr>               
                    <td><span>Login Form</span></td>                
                </tr>

                <tr>               
                    <td>Email</td>
                    <td><input type="text" name="email" size="50"> <label>*</label></td>                
                </tr>

                <tr>               
                    <td>Password</td>
                    <td><input type="password" name="password" size="50"> <label>*</label></td>                
                </tr>

                <tr>               
                    <td></td>
                    <td><input type="checkbox" name="remember_me">Remember Me</td>                
                </tr>

                <tr>               
                    <td></td>
                    <td><a href="{{ URL::to('/forget_password') }}">forget password?</a></td>                
                </tr>

                <tr>               
                    <td></td>
                    <td><button type="submit">Login</button></td>                
                </tr>         
            </table>
        </div>
    </form>
</body>
</html>
