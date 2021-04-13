<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use File;

class UserController extends Controller
{
	public function users()
	{
		$userList = User::latest()->paginate(5);
		return view('user.userlist',['userList' => $userList]);
	}


	public function userProfile()
	{
		if (Auth::user()->type == 0) {
			$type = 'Admin';
		} else {
			$type = 'User';
		}
		return view('user.userprofile',['type' => $type]);
	}

	// create post form
	public function createUser() 
	{
		return view('user.createuser');
	}

	// confirm create post
	public function createUserConfirm(Request $request)
	{
		$this->validate(request(),[
			'name'=>'required|unique:users|max:255',
			'email'=>'required|email',
			'type'=>'required',
			'password' => 'required|min:8|numeric',
			'confirm_password'=>'same:password|required',
			'profile'=>'required|mimes:jpeg,png|max:1024',
		]);

		$name = $request->get('name');
		$email = $request->get('email');
		$type = $request->get('type');
		if ($type == 0) {
			$role = 'Admin';
		} else {
			$role = 'User';
		}
		$phone = $request->get('phone');
		$dob = $request->get('dob');
		$password = bcrypt($request->get('password'));
		$address = $request->get('address');
		$profile = $request->file('profile');

		$imageName = time().'.'.$request->file('profile')->extension();

        $request->file('profile')->move(public_path('images'), $imageName);


		return view('user.createuserconfirm',['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'password' => $password, 'address' => $address, 'profile' => $imageName, 'role' => $role]);
	}

	// store post to db
	public function storeUser(Request $request) 
	{
		$user = new User;
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->type = $request->get('type');
		$user->phone = $request->get('phone');
		$user->dob = $request->get('dob');
		$user->password = $request->get('password');
		$user->address = $request->get('address');
		$user->profile = $request->get('profile');
		$user->create_user_id = Auth::user()->id;
		$user->updated_user_id = Auth::user()->id;
		$user->created_at = Carbon::now();
		$user->updated_at = Carbon::now();
		$user->save();
		return redirect('/users')->with('success','User created successfully!');
	}

	// retrieve data for update user form
	public function editUser() 
	{
		$user = user::findOrFail(Auth::user()->id);
		$name = $user->name;
		$email = $user->email;
		$type = $user->type;
		$phone = $user->phone;
		$dob = $user->dob;
		$address = $user->address;
		$profile = $user->profile;
		return view('user.updateuser', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => $profile]);
	}

	// show data for update user form
	public function editUserConfirm($id, Request $request) 
	{
		// dd($request);
		$this->validate(request(),[
			'name'=>'required|unique:users|max:255',
			'email'=>'required',
			'type'=>'required',
			'profile'=>'required',
		]);

		$ids = $id;
		$name = $request->get('name');
		$email = $request->get('email');
		$type = $request->get('type');
		if ($type == 0) {
			$role = 'Admin';
		} else {
			$role = 'User';
		}
		$phone = $request->get('phone');
		$dob = $request->get('dob');
		$address = $request->get('address');
		$profile = $request->get('profile');

		$imageName = time().'.'.$request->file('profile')->extension();

        $request->file('profile')->move(public_path('images'), $imageName);

		return view('user.updateuserconfirm', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => $imageName, 'id' => $ids, 'role' => $role]);
	}

	// update user data to db
	public function updateUser(Request $request,$id) 
	{
		$user = User::findOrFail($id);
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->type = $request->get('type');
		$user->phone = $request->get('phone');
		$user->dob = $request->get('dob');
		$user->address = $request->get('address');
		$user->profile = $request->get('profile');
		$user->updated_user_id = Auth::user()->id;
		$user->updated_at = Carbon::now();
		$user->save();
		return redirect('/posts')->with('success', 'User updated successfully!');
	}

	// delete user data to db
	public function deleteUser() 
	{
		$user = User::findOrFail(Auth::user()->id);
		$user->deleted_user_id = Auth::user()->id;
		$user->deleted_at = Carbon::now();
		$user->update();
		return redirect('users')->with('success','User temporarily deleted!');
	}

	// changePassword
	public function changePasswordView() 
	{
		$user = User::findOrFail(Auth::user()->id);
		$old_password = $user->password;
		return view('user.changepassword', ['old_password' => $old_password]);
	}

	// changePassword
	public function changePassword(Request $request) 
	{
		$this->validate(request(),[
			'new_password'=>'required|min:8',
			'confirm_new_password'=>'required|min:8|same:new_password',
		]);

		// $old_password = User::find(Auth::user()->id);

		// if ($old_password != bcrypt($request->get('password'))) {
		// 	$error = array('password' => 'Please enter correct current password');
		// 	return response()->json(array('error' => $error), 400);
		// }
		$id = Auth::user()->id;
		$user = User::findOrFail($id);
		$user->password = bcrypt($request->get('new_password'));
		$user->updated_user_id = Auth::user()->id;
		$user->updated_at = Carbon::now();
		$user->update();
		return redirect('posts')->with('success','Password Change successfully!');
	}

	public function searchUser(Request $request) 
	{
		$name = $request->get('name');
		$email = $request->get('email');
		$from = $request->get('from');
		$to = $request->get('to');
		
		if ($name) {
			$userList = User::where('name', 'LIKE', '%'.$name.'%')->paginate(5);
		}

		elseif ($email) {
			$userList = User::where('email', 'LIKE', '%'.$email.'%')->paginate(5);
		}

		elseif ($from) {
			$userList = User::where('created_at', '>', $from)->get()->paginate(5);
		}

		elseif ($to) {
			$userList = User::where('created_at', '<', $to)->get()->paginate(5);
		}

		else {
			$userList = User::whereBetween('created_at', [$from, $to])->paginate(5);
		}
			
		return view('user.userlist',['userList' => $userList]);
	}
}
	