@extends('layouts.header')

@section('content')

<div style="margin-left: 150px;width: 1200px;">

  <div style="margin: 40px 0 50px 0">
    <h4>User List</h4>
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="from" placeholder="Created From">
    <input type="text" name="to" placeholder="Created From">
    <button style="background-color: lightblue;">Search</button>
    <button href="#" style="background-color: lightblue;">Add</button>
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
          <td>{{ $user->created_user }} </td>
          <td>{{ $user->phone }}</td>   
          <td>{{ $user->dob }}</td>    
          <td>{{ $user->address }}</td>
          <td>{{ $user->created_date }}</td>
          <td>{{ $user->updated_date }}</td>
          <td><a href="{{ URL::to('/details/'.$user->id)}}"> Delete </a></td>
        </tr>
    @endforeach
  </table>
  {{ $userList->links() }}

</div>
@endsection
