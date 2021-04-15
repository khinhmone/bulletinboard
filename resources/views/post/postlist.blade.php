@extends('layouts.master')

@section('content')

<div style="margin-left: 150px;width: 1200px;">

  <div style="margin: 40px 0 50px 0">
    @if ($message = Session::get('success'))
      <div class="alert alert-info alert-dismissible" role="alert">
        <strong>{{ $message }}!</strong>
      </div>
    @endif
    <h4>Post List</h4>
    <form action="{{ URL::to('/search') }}" method="post">
      {{ csrf_field() }}
      <input type="text" name="search">
      <button type="submit" class="btn btn-primary">Search</button>
      <a href="{{ URL::to('/create_post_view')}}" class="btn btn-primary">Add</a>
      <a href="{{ URL::to('/upload_csv_view')}}" class="btn btn-primary">Upload</a>
      <a href="{{ route('file-export') }}" class="btn btn-primary">Download</a>
    </form>

  </div>
    
    <table class="table table-bordered table-sm">
      <tr>
        <th>Post Title</th>
        <th>Post Description</th>   
        <th>Posted User</th>
        <th>Posted Date</th>
        <th></th>
        <th></th>  
      </tr>
      @if(isset($postList))
      @if(sizeof($postList) > 0)
      @foreach($postList as $post)    
        <tr>    
          <td id="post_id_{{ $post->id }}"><a class="btn btn-link" id="post-info" href="" data-toggle="modal" data-target="#exampleModal" data-id="{{ $post->id }}">{{ $post->title }}</a></td>
          <td>{{ $post->description }}</td>
          <td>{{ $post->name }} </td>
          <td>{{ $post->formatted_created_at }}</td>   
          <td><a href="{{ URL::to('/edit_post_view/'.$post->id)}}"> Edit </a></td>    
          <td><a href="{{ URL::to('/delete_post/'.$post->id)}}" onclick="return confirm('Are you sure to delete {{ $post->title }}?');"> Delete </a></td>
          <input type="hidden" class="form-control title_{{$post->id}}" id="title" value="{{ $post->title }}">
          <input type="hidden" class="form-control description_{{$post->id}}" id="description" value="{{ $post->description }}">
          <input type="hidden" class="form-control status_{{$post->id}}" id="status" value="{{ $post->status }}">
          <input type="hidden" class="form-control createdat_{{$post->id}}" id="created_at" value="{{ $post->created_at }}">
          <input type="hidden" class="form-control created_user_{{$post->id}}" id="created_user_id" value="{{ $post->create_user_id }}">
          <input type="hidden" class="form-control updatedat_{{$post->id}}" id="updated_at" value="{{ $post->updated_at }}">
          <input type="hidden" class="form-control updateuser_{{$post->id}}" id="updated_user_id" value="{{ $post->updated_user_id }}">
        </tr>
    @endforeach
    @endif
    @endif
  </table>
  {{ $postList->links() }}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Deatail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="post_title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="description" class="form-control" id="post_description">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="post_status">
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created_At</label>
                        <input type="text" class="form-control" id="post_created_at">
                    </div>
                    <div class="form-group">
                        <label for="created_user_id">Created_User_ID</label>
                        <input type="text" class="form-control" id="post_created_user_id">
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Updated_At</label>
                        <input type="text" class="form-control" id="post_updated_at">
                    </div>
                    <div class="form-group">
                        <label for="updated_user_id">Updated_User_ID</label>
                        <input type="text" class="form-control" id="post_updated_user_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

</div>
@endsection
