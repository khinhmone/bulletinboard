<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
	public function users()
	{
		$userList = User::latest()->paginate(5);
		return view('user.userlist',['userList' => $userList]);
	}


	public function userProfile()
	{
		if (Auth::user()->id == 1) {
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
			'email'=>'required',
			'password'=>'required',
			'confirm_password'=>'same:password|required',
			'profile'=>'required',
		]);

		$name = $request->get('name');
		$email = $request->get('email');
		return view('user.createuserconfirm',['name' => $name, 'email' => $email]);
	}

	// store post to db
	public function storeUser(Request $request) 
	{
		$user = new User;
		$user->name = $request->get('name');
		$user->email = $request->get('email');
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
	public function editUserConfirm(Request $request) 
	{
		// dd($request);
		$this->validate(request(),[
			'name'=>'required|unique:users|max:255',
			'email'=>'required',
			'type'=>'required',
			'profile'=>'required',
		]);

		$name = $request->input('name');
		$email = $request->input('email');
		$type = $request->input('type');
		$phone = $request->input('phone');
		$dob = $request->input('dob');
		$address = $request->input('address');
		$profile = $request->file('profile');
		return view('user.updateuserconfirm', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => $profile]);
	}

	// update user data to db
	public function updateUser(Request $request) 
	{
		// dd('pppp');
		$this->validate(request(),[
			'name'=>'required|unique:users|max:255',
			'email'=>'required',
			'type'=>'required',
			'profile'=>'required',
		]);

		$user = User::findOrFail(Auth::user()->id);
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->type = $request->get('type');
		$user->phone = $request->get('phone');
		$user->dob = $request->get('dob');
		$user->address = $request->get('address');
		$user->updated_user_id = Auth::user()->id;
		$user->updated_at = Carbon::now();
		$user->save();
		return redirect('/posts')->with('success', 'User updated successfully!');
	}

	// delete user data to db
	public function deleteUser() 
	{
		$user = user::findOrFail(Auth::user()->id);
		$user->deleted_user_id = Auth::user()->id;
		$user->deleted_at = Carbon::now();
		$user->update();
		return redirect('users')->with('success','User temporarily deleted!');
	}
}
	