@extends('layouts.master')

@section('content')

<br>
<div class="container">
  <div class="row justify-content-left">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create User Confirmation</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/store_user') }}">
              @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
                  <div class="col-md-6">
                    <label>{{ $name }}</label>
                    <input type="hidden" name="name" value="{{ $name }}">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-6">
                      <label>{{ $email }}</label>
                      <input type="hidden" name="email" value="{{ $email }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                      <label>**********</label>
                      <input type="hidden" name="password" value="{{ $password }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Type</label>
                    <div class="col-md-6">
                      <label>{{ $type }}<label>
                      <input type="hidden" name="type" value="{{ $type }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Phone</label>
                    <div class="col-md-6">
                      <label>{{ $phone }}</label>
                      <input type="hidden" name="phone" value="{{ $phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                    <div class="col-md-6">
                      <label>{{ $dob }}</label>
                      <input type="hidden" name="dob" value="{{ $dob }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6">
                      <label>{{ $address }}</label>
                      <input type="hidden" name="address" value="{{ $address }}">
                    </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ URL::to('/create_post_view') }}" class="btn btn-light">Cancel</a>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
