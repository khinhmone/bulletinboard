@extends('layouts.master')

@section('content')

<style type="text/css">
  select{
    width: 255px;
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
        <div class="card-header">Change Password</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/change_password') }}" id="changepwd">
              {{ csrf_field() }}
                <!-- Old Password -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Old Password <span>*</span></label>
                  <div class="col-md-6">
                    <label></label>
                    <input type="password" class="form-control" name="current_password" id="current_password">
                    @if ($errors->has('current_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- email address -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">New Password <span>*</span></label>
                  <div class="col-md-6">
                    <label></label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                    @if ($errors->has('new_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- type -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-left">Confirm New Password <span>*</span></label>
                  <div class="col-md-6">
                    <label></label>
                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password">
                    @if ($errors->has('confirm_new_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('confirm_new_password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Change</button>
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
