@extends('layouts.master')

@section('content')

<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">User Profile <a href="/edit_user_view/{{Auth::user()->id}}" style="margin-left: 300px;">Edit</a></div>
          <div class="card-body">
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-left">Name</label>
              <div class="col-md-6">
                <label class="col-md-6 col-form-label text-md-left">{{ Auth::user()->name }}</label>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-left"></label>
              <div class="col-md-6">
                @if ($profile)
                <img src="{{ $profile }}" class="img-rounded" width="80" height="80">
                @endif
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-left">Email Address</label>
                <div class="col-md-6">
                  <label class="col-md-6 col-form-label text-md-left">{{ Auth::user()->email }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-left">Type</label>
                <div class="col-md-6">
                  <label class="col-md-6 col-form-label text-md-left">{{ $type }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-left">Phone</label>
                <div class="col-md-6">
                  <label class="col-md-6 col-form-label text-md-left">{{ Auth::user()->phone }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-left">Date Of Birth</label>
                <div class="col-md-6">
                  <label class="col-md-6 col-form-label text-md-left">{{ Auth::user()->dob }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-left">Address</label>
                <div class="col-md-6">
                  <label class="col-md-6 col-form-label text-md-left">{{ Auth::user()->address }}</label>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
