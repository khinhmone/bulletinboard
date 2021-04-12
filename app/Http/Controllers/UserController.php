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
			'email'=>'required|email',
			'type'=>'required',
			'password' => [
                'required',
                'min:8',
                'numeric',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            ],
			'confirm_password'=>'same:password|required',
			'profile'=>'required',
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
		return view('user.createuserconfirm',['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'password' => $password, 'address' => $address, 'profile' => $profile, 'role' => $role]);
	}

	// store post to db
	public function storeUser(Request $request) 
	{
		// $path = public_path().Auth::user()->id.'/images/';
		// File::makeDirectory($path, $mode = 0777, true, true);

		// $profile = $request->file('profile');
		// $filename = $profile->getClientOriginalName();
		// $profile->move($path,$filename);
		// $profile = $filename;

		$user = new User;
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->type = $request->get('type');
		$user->phone = $request->get('phone');
		$user->dob = $request->get('dob');
		$user->password = $request->get('password');
		$user->address = $request->get('address');
		// $user->profile = $profile;
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
		$name = $request->input('name');
		$email = $request->input('email');
		$type = $request->input('type');
		if ($type == 0) {
			$role = 'Admin';
		} else {
			$role = 'User';
		}
		$phone = $request->input('phone');
		$dob = $request->input('dob');
		$address = $request->input('address');
		$profile = $request->file('profile');
		return view('user.updateuserconfirm', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => $profile, 'id' => $ids, 'role' => $role]);
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
		// $this->validate(request(),[
		// 	'old_password'=>'required',
		// 	'new_password'=>'required|min:8',
		// 	'confirm_new_password'=>'required|min:8|same:new_password',
		// ]);

		// $old_password = $request->get('old_password');
		// if ($old_password != bcrypt($request->get('password'))) {
		// 	# code...
		// }
		// dd($request);
		$id = Auth::user()->id;
		$user = User::findOrFail($id);
		$user->password = bcrypt($request->get('new_password'));
		$user->updated_user_id = Auth::user()->id;
		$user->updated_at = Carbon::now();
		$user->update();
		return redirect('posts')->with('success','Password Change successfully!');


		// if(!is_null($post)) {
	// 					$data["status"] = "success";
	// 					$data["message"] = "Post imported successfully";
	// 				}  



			// return redirect('/posts')->with($data["status"], $data["message"]);



	}

	public function searchUser(Request $request) 
	{
		$name = $request->get('name');
		$email = $request->get('email');
		$from = $request->get('from');
		$to = $request->get('to');
		if ($name) {
			$userList = User::where('name', 'LIKE', '%'.$name.'%')->get();
		}

		if ($email) {
			$userList = User::where('email', 'LIKE', '%'.$email.'%')->get();
		}

		if ($from) {
			$userList = User::where('created_at', '>', $from)->get();
		}

		if ($to) {
			$userList = User::where('created_at', '<', $to)->get();
		}

		if ($from && $to) {
			$userList = User::whereBetween('created_at', [$from, $to]);
		}
			
		return view('user.usersearchresult',compact('userList'));
	}
}
	