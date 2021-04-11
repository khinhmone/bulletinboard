@extends('layouts.master')

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
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update Post Confirmation</div>
          <div class="card-body">
            <form method="POST" action="/update_post/{{$id}}">
              {{ csrf_field() }}
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Title :</label>
                  <div class="col-md-6">
                    <label>{{ $title }}</label>
                    <input type="hidden" name="title" value="{{ $title }}">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Description :</label>
                    <div class="col-md-6">
                      <label>{{ $description }}</label>
                      <input type="hidden" name="description" value="{{ $description }}">
                    </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Status :</label>
                  <div class="col-md-6">
                    <div class="form-check form-switch">
                      <input name="status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $checked }}>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <!-- <a href="{{ URL::to('/update_post_view') }}" class="btn btn-light">Cancel</a> -->
                    <a href="/edit_post_view/{{$id}}" class="btn btn-light">Cancel</a>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
