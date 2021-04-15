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
          <td id="user_id_{{ $user->id }}">
            <a class="btn btn-link" id="user-info" href="" data-toggle="modal" data-target="#exampleModal" data-id="{{ $user->id }}">{{ $user->name }}</a> </td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }} </td>
          <td>{{ $user->phone }}</td>   
          <td>{{ $user->dob }}</td>    
          <td>{{ $user->address }}</td>
          <td>{{ $user->formatted_created_at }}</td>
          <td>{{ $user->formatted_updated_at }}</td>
          <td><a href="{{ URL::to('/delete_user/'.$user->id)}}"> Delete </a></td>

          <input type="hidden" class="form-control name_{{$user->id}}" id="name" value = "{{ $user->name }}">
          <input type="hidden" class="form-control email_{{$user->id}}" id="email" value = "{{ $user->email }}">
          <input type="hidden" class="form-control type_{{$user->id}}" id="type" value = "{{ $user->type }}" >
          <input type="hidden" class="form-control phone_{{$user->id}}" id="phone" value = "{{ $user->phone }}">
          <input type="hidden" class="form-control address_{{$user->id}}" id="address" value = "{{ $user->address }}">
          <input type="hidden" class="form-control dob_{{$user->id}}" id="dob" value = "{{ $user->dob }}">
        </tr>
    @endforeach
  </table>
  {{ $userList->links() }}

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
                <form>
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="useremail">Email</label>
                        <input type="text" class="form-control" id="useremail">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="usertype">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="userphone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="useraddress">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" class="form-control" id="userdob">
                    </div>
                </form>
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
