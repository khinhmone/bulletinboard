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
        <div class="card-header">Update User Confirmation</div>
          <div class="card-body">
            <form method="POST" action="/update_user/{{$id}}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Name : </label>
                  <div class="col-md-4">
                    <label class="col-md-8 col-form-label text-md-left">{{ $name }}</label>
                    <input type="hidden" name="name" value="{{ $name }}">
                  </div>
                  <div class="col-md-4 text-md-center">
                    <img src="{{ $profile }}" class="img-rounded" width="80" height="80">
                    <input type="hidden" name="profile" value="{{ $profile }}">
                  </div>
                </div>

                <!-- email address -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Email Address : </label>
                  <div class="col-md-4">
                    <label class="col-md-9 col-form-label text-md-left">{{ $email }}</label>
                    <input type="hidden" name="email" value="{{ $email }}">
                  </div>
                </div>

                <!-- type -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Type : </label>
                  <div class="col-md-4">
                    <label class="col-md-9 col-form-label text-md-left">{{ $role }}</label>
                    <input type="hidden" name="type" value="{{ $type }}">
                  </div>
                </div>

                <!-- Phone -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Phone : </label>
                  <div class="col-md-4">
                    <label class="col-md-9 col-form-label text-md-left">{{ $phone }}</label>
                    <input type="hidden" name="phone" value="{{ $phone }}">
                  </div>
                </div>

                <!-- Date Of Birth -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Date Of Birth : </label>
                  <div class="col-md-4">
                    <label class="col-md-9 col-form-label text-md-left">{{ $dob }}</label>
                    <input type="hidden" name="dob" value="{{ $dob }}">
                  </div>
                </div>

                <!-- Address -->
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Address : </label>
                  <div class="col-md-4">
                    <label class="col-md-9 col-form-label text-md-left">{{ $address }}</label>
                    <input type="hidden" name="address" value="{{ $address }}">
                  </div>
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
