@extends('layouts.header')

@section('content')

<br>
<div class="container">
  <div class="row justify-content-left">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update Post</div>
          <div class="card-body">
            <form method="POST" action="/edit_post_confirm/{{$id}}">
              {{ csrf_field() }}
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Title</label>
                  <div class="col-md-6">
                    <!-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> -->
                    <input type="text" class="form-control" name="title" value="{{ $title }}" autofocus>

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Description</label>
                  <div class="col-md-6">
                    <textarea name="description" class="form-control" rows="3">{{ $description }}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Status</label>
                  <div class="col-md-6">
                    <div class="form-check form-switch">
                      <input name="status" value="{{ $status }}" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $checked }}>
                    </div>
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
