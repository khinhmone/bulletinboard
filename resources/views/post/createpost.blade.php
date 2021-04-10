@extends('layouts.header')

@section('content')

<br>
@if ($errors->any())
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
@endif
<div class="container">
  <div class="row justify-content-left">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Post</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/create_post_confirm') }}">
              @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Title</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="title" autofocus>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-6">
                      <textarea name="description" class="form-control" rows="3"></textarea>
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
