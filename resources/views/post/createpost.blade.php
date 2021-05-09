@extends('layouts.master')

@section('content')

<style type="text/css">
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
        <div class="card-header">Create Post</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/create_post_confirm') }}">
              @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Title</label>
                  <div class="col-md-6">
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-md-2 text-md-left">
                    <span>*</span>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-6">
                      <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>

                      @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                    </div>
                    <div class="col-md-2 text-md-left">
                    <span>*</span>
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
