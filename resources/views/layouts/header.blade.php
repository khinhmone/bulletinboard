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
    <link href="{{ URL::asset('../bootstrap-5/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- image preview -->
    <script>
      var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src)
        }
      };
    </script>

    <!-- get data to modal box -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#user-info', function(event) {
               $id = $(this).attr('data-id');
               $('#username').val($(".name_"+$id).val());
               $('#useremail').val($(".email_"+$id).val());
               $('#usertype').val($(".type_"+$id).val());
               $('#userphone').val($(".phone_"+$id).val());
               $('#useraddress').val($(".address_"+$id).val());
               $('#userdob').val($(".dob_"+$id).val());
            });
        });

        $(document).on('click', '#post-info', function(event) {
           $id =  $(this).attr('data-id');
           $('#post_title').val($(".title_"+$id).val());
           $('#post_description').val($(".description_"+$id).val());
           $('#post_status').val($(".status_"+$id).val());

            var created = $(".createdat_"+$id).val();
            var created_year = created.substr(0, 4);
            var created_month = created.substr(5, 2);
            var created_date = created.substr(8, 2);
            var created_at = created_year +'/'+ created_month +'/'+created_date;

            var updated = $(".updatedat_"+$id).val();
            var updated_year = updated.substr(0, 4);
            var updated_month = updated.substr(5, 2);
            var updated_date = updated.substr(8, 2);
            var updated_at = updated_year +'/'+ updated_month +'/'+updated_date;

           $('#post_created_at').val(created_at);
           $('#post_created_user_id').val($(".created_user_"+$id).val());
           $('#post_updated_at').val(updated_at);
           $('#post_updated_user_id').val($(".updateuser_"+$id).val());
        });        
    </script>

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
                  <!-- @if(isset(Auth::user()->type)) -->
                    <!-- @if(Auth::user()->type == 0) -->
                        <li class="nav-item">
                            <a class="nav-link" href="/users">Users</a>
                        </li>
                    <!-- @endif -->
                  <!-- @endif -->
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
                            <a class="nav-link" href="{{ URL::to('/user/logout') }}">Logout</a>
                        </li>
                    </ul>
                </form>
            </div>
        </nav>
    </div>
</body>
</html>
