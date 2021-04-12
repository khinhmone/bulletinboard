@extends('layouts.master')

@section('content')

<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Upload CSV File</div>
          <div class="card-body">
            <form method="POST" action="{{ URL::to('/upload_csv_process') }}">
              @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Import File From:</label>
                  <div class="col-md-6">
                    <input type="file" name="csv_file" class="form-control">
                    @if ($errors->has('csv_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('csv_file') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Import File</button>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
