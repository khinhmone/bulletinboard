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
      <button style="background-color: lightblue;">Upload</button>
      <button style="background-color: lightblue;">Download</button>
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
      @foreach($postList as $post)    
        <tr>    
          <td><a href="">{{ $post->title }}</a></td>
          <td>{{ $post->description }}</td>
          <td>{{ $post->name }} </td>
          <td>{{ $post->created_at }}</td>   
          <td><a href="{{ URL::to('/edit_post_view/'.$post->id)}}"> Edit </a></td>    
          <td><a href="{{ URL::to('/delete_post/'.$post->id)}}" onclick="return confirm('Are you sure to delete {{ $post->title }}?');"> Delete </a></td>
        </tr>
    @endforeach
  </table>
  {{ $postList->links() }}

</div>
@endsection
