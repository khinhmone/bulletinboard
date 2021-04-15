@extends('layouts.master')

@section('content')

<style type="text/css">
  select{
    width: 208px;
    height: 35px;
    border: 1px solid lightgray;
    border-radius: 4px;
  }
  span{
    color: red;
    margin-left: 20px;
  }
</style>

<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update User</div>
          <div class="card-body">
            <form method="POST" action="/edit_user_confirm/{{Auth::user()->id}}"  enctype="multipart/form-data">
              {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Name <span>*</span></label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="name" value="{{ $name }}" autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-md-4 text-md-center">
                    @if($profile)
                    <img src="{{ $profile }}" class="img-rounded" width="80" height="80">
                    @endif
                  </div>
                </div>

                <!-- email address -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Email Address <span>*</span></label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="email" value="{{ $email }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- type -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Type <span>*</span></label>
                  <div class="col-md-4">
                    <select name="type">
                      <option value=""></option>
                      <option value="0">Admin</option>
                      <option value="1">User</option>
                    </select>

                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- Phone -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Phone</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="phone" value="{{ $phone }}">
                  </div>
                </div>

                <!-- Date Of Birth -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Date Of Birth</label>
                  <div class="col-md-4">
                    <input type="date" class="form-control" name="dob" value="{{ $dob }}">
                  </div>
                </div>

                <!-- Address -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Address</label>
                  <div class="col-md-4">
                    <textarea class="form-control" name="address">{{ $address }}</textarea>
                  </div>
                </div>

                <!-- Profile -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Profile <span>*</span></label>
                  <div class="col-md-4">
                    <input type="file" accept="image/*" name="profile" class="form-control" onchange="loadFile(event)">
                    <img id="output"/>

                    @if ($errors->has('profile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('profile') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- Image preview output -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left"></label>
                  <div class="col-md-4">
                    <img src="">
                  </div>
                </div>

                <!-- change password -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">
                    <a href="{{ URL::to('/change_password_view')}}">Change Password</a>
                  </label>
                </div>                

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="reset" class="btn btn-light">Clear</button>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
