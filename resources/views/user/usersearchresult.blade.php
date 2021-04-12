@extends('layouts.master')

@section('content')

<div style="margin-left: 150px;width: 1200px;">

  <div style="margin: 40px 0 50px 0">
    @if ($message = Session::get('success'))
      <div class="alert alert-info alert-dismissible" role="alert">
        <strong>{{ $message }}!</strong>
      </div>
    @endif
    <h4>User List</h4>
    <form action="{{ URL::to('/user_search') }}" method="post">
      {{ csrf_field() }}
      <input type="text" name="name" placeholder="Name">
      <input type="text" name="email" placeholder="Email">
      <input type="date" name="from" placeholder="Created From">
      <input type="date" name="to" placeholder="Created To">
      <button class="btn btn-primary">Search</button>
      <a href="/create_user_view" class="btn btn-primary">Add</a>
    </form>
  </div>
    
    <table class="table table-bordered table-sm">
      <tr>
        <th>Name</th>
        <th>Email</th>   
        <th>Created User</th>
        <th>Phone</th>
        <th>Birth Date</th>
        <th>Address</th>  
        <th>Created Date</th>
        <th>Updated Date</th>
        <th></th>
      </tr>
      @foreach($userList as $user)    
        <tr>    
          <td><a href=""> {{ $user->name }}</a> </td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }} </td>
          <td>{{ $user->phone }}</td>   
          <td>{{ $user->dob }}</td>    
          <td>{{ $user->address }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->updated_at }}</td>
          <td><a href="{{ URL::to('/delete_user/'.$user->id)}}"> Delete </a></td>
        </tr>
    @endforeach
  </table>
</div>
@endsection
