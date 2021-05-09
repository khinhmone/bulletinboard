<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use File;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserList()
  {
    $userList = DB::table('users')
             ->select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
             	DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)
             ->latest()->paginate(5);
    return $userList;
  }

  public function getUserProfile()
  {
    $photo = '';
    $type = (Auth::user()->type == 0) ? 'Admin' : 'User';
    if (Auth::user()->profile) {
      $profile = Auth::user()->profile;
      $exp_prof = explode('/', $profile);
      $photo = $exp_prof[1].'/'.$exp_prof[2].'/'.$exp_prof[3];
    }    
    return view('user.userprofile',['type' => $type, 'profile' => $photo]);
  }

  public function saveUser(Request $request)
  {
    $user = new User;
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->type = $request->get('type');
    $user->phone = $request->get('phone');
    $user->dob = $request->get('dob');
    $user->password = $request->get('password');
    $user->address = $request->get('address');
    $user->profile = 'public/'.$request->get('profile');
    $user->create_user_id = Auth::user()->id;
    $user->updated_user_id = Auth::user()->id;
    $user->created_at = Carbon::now();
    $user->updated_at = Carbon::now();
    $user->save();
  }

  public function saveUserConfirm(Request $request)
  {
    $name = $request->get('name');
    $email = $request->get('email');
    $type = $request->get('type');
    $role = ($type == 0) ? 'Admin' : 'User';    
    $phone = $request->get('phone');
    $dob = $request->get('dob');
    $password = bcrypt($request->get('password'));
    $address = $request->get('address');
    $profile = $request->file('profile');

    $imageName = time().'.'.$request->file('profile')->extension();

    $request->file('profile')->move(public_path('/'.Auth::user()->id.'/images/'), $imageName);

    return view('user.createuserconfirm',[
      'name' => $name, 
      'email' => $email, 
      'type' => $type, 
      'phone' => $phone, 
      'dob' => $dob, 
      'password' => $password, 
      'address' => $address, 
      'profile' => Auth::user()->id.'/images/'.$imageName, 
      'role' => $role]);
  }

  public function getUserById($id)
  {
    $photo = '';
    $user = user::findOrFail($id);
    $name = $user->name;
    $email = $user->email;
    $type = $user->type;
    $phone = $user->phone;
    $dob = $user->dob;
    $address = $user->address;
    $profile = $user->profile;
    if ($profile) {
      $exp_prof = explode('/', $profile);
      $photo = '/'.$exp_prof[1].'/'.$exp_prof[2].'/'.$exp_prof[3];
    }
    return view('user.updateuser', [
      'name' => $name, 
      'email' => $email, 
      'type' => $type, 
      'phone' => $phone, 
      'dob' => $dob, 
      'address' => $address, 
      'profile' => $photo]);
  }

  public function updateUser($id, Request $request)
  {
    $user = User::findOrFail($id);
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->type = $request->get('type');
    $user->phone = $request->get('phone');
    $user->dob = $request->get('dob');
    $user->address = $request->get('address');
    $user->profile = 'public'.$request->get('profile');
    $user->updated_user_id = Auth::user()->id;
    $user->updated_at = Carbon::now();
    $user->save();
  }

  public function updateUserConfirm($id, Request $request)
  {
    $ids = $id;
    $name = $request->get('name');
    $email = $request->get('email');
    $type = $request->get('type');
    $role = ($type == 0) ? 'Admin' : 'User';
    $phone = $request->get('phone');
    $dob = $request->get('dob');
    $address = $request->get('address');
    $profile = $request->get('profile');
    // dd($address);

    $imageName = time().'.'.$request->file('profile')->extension();

    $request->file('profile')->move(public_path('/'.Auth::user()->id.'/images/'), $imageName);

    return view('user.updateuserconfirm', [
      'name' => $name, 
      'email' => $email, 
      'type' => $type, 
      'phone' => $phone, 
      'dob' => $dob, 
      'address' => $address, 
      'profile' => '/'.Auth::user()->id.'/images/'.$imageName, 
      'id' => $ids, 
      'role' => $role]);
  }

  public function deleteUser($id)
  {
    $user = User::findOrFail($id);
    $user->deleted_user_id = Auth::user()->id;
    $user->deleted_at = Carbon::now();
    $user->update();
  }

  public function searchUser($name, $email, $from, $to)
  {
    if ($name) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->where('name', 'LIKE', '%'.$name.'%')->paginate(5);
    }

    elseif ($email) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->where('email', 'LIKE', '%'.$email.'%')->paginate(5);
    }

    elseif ($from) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->where('created_at', '>=', $from)->paginate(5);
    }

    elseif ($to) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->where('created_at', '<', $to)->paginate(5);
    }

    elseif ($from && $to) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->whereBetween('created_at', [$from, $to])->paginate(5);
    }

    elseif ($name && $email) {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
              ->where('users.deleted_at','=',null)->where('name', 'LIKE', '%'.$name.'%')
              ->where('email', 'LIKE', '%'.$email.'%')->paginate(5);
    }

    else {
      $userList = User::select('users.*', DB::raw('DATE_FORMAT(users.created_at, "%d/%m/%Y") as formatted_created_at'), 
              DB::raw('DATE_FORMAT(users.updated_at, "%d/%m/%Y") as formatted_updated_at'))
             ->where('users.deleted_at','=',null)->latest()->paginate(5);
    }
    return $userList;
  }

  public function changepassword($request)
  {
    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
      // The passwords matches
      $error = array('password' => 'Please enter correct current password');
      return response()->json(array('error' => $error), 400);
    }
    elseif (strcmp($request->get('current_password'), $request->get('new_password')) == 0){
      //Current password and new password are same
      $error = array('password' => 'New Password cannot be same as your current password. Please choose a different password.');
      return response()->json(array('error' => $error), 400);
    }
    else {
      //Change Password
      $user = Auth::user();
      $user->password = bcrypt($request->get('new_password'));
      $user->updated_user_id = Auth::user()->id;
      $user->updated_at = Carbon::now();
      $user->save();
    } 
  }
}
