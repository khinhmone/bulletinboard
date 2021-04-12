@extends('layouts.master')

@section('content')

<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Post Confirmation</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/store_post') }}">
              @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Title :</label>
                  <div class="col-md-6">
                    <label class="col-md-4 col-form-label text-md-left">{{ $title }}</label>
                    <input type="hidden" name="title" value="{{ $title }}">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Description :</label>
                    <div class="col-md-6">
                      <label class="col-md-4 col-form-label text-md-left">{{ $description }}</label>
                      <input type="hidden" name="description" value="{{ $description }}">
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
