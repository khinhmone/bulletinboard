<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
		$photo = '';
		$type = (Auth::user()->type == 0) ? 'Admin' : 'User';
		if (Auth::user()->profile) {
			$profile = Auth::user()->profile;
			$exp_prof = explode('/', $profile);
			$photo = $exp_prof[1].'/'.$exp_prof[2].'/'.$exp_prof[3];
		}
		
		return view('user.userprofile',['type' => $type, 'profile' => $photo]);
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
		$role = ($type == 0) ? 'Admin' : 'User';		
		$phone = $request->get('phone');
		$dob = $request->get('dob');
		$password = bcrypt($request->get('password'));
		$address = $request->get('address');
		$profile = $request->file('profile');

		$imageName = time().'.'.$request->file('profile')->extension();

        $request->file('profile')->move(public_path('/'.Auth::user()->id.'/images/'), $imageName);


		return view('user.createuserconfirm',['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'password' => $password, 'address' => $address, 'profile' => Auth::user()->id.'/images/'.$imageName, 'role' => $role]);
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
		$user->profile = 'public/'.$request->get('profile');
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
		$photo = '';
		$user = user::findOrFail(Auth::user()->id);
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
		// dd($photo);
		return view('user.updateuser', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => $photo]);
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
		$role = ($type == 0) ? 'Admin' : 'User';
		$phone = $request->get('phone');
		$dob = $request->get('dob');
		$address = $request->get('address');
		$profile = $request->get('profile');
		// dd($address);

		$imageName = time().'.'.$request->file('profile')->extension();

        $request->file('profile')->move(public_path('/'.Auth::user()->id.'/images/'), $imageName);


		return view('user.updateuserconfirm', ['name' => $name, 'email' => $email, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'profile' => '/'.Auth::user()->id.'/images/'.$imageName, 'id' => $ids, 'role' => $role]);
	}

	// update user data to db
	public function updateUser(Request $request,$id) 
	{
		// dd($request);
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
			'current_password' => 'required',
			'new_password'=>'required|min:8',
			'confirm_new_password'=>'required|min:8|same:new_password',
		]);
		if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            $error = array('password' => 'Please enter correct current password');
			return response()->json(array('error' => $error), 400);
        }

        elseif(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            $error = array('password' => 'New Password cannot be same as your current password. Please choose a different password.');
			return response()->json(array('error' => $error), 400);
        } else {
	       	//Change Password
	        $user = Auth::user();
	        $user->password = bcrypt($request->get('new_password'));
	        $user->updated_user_id = Auth::user()->id;
			$user->updated_at = Carbon::now();
	        $user->save();
        }  
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
			$userList = User::where('created_at', '>=', $from)->paginate(5);
		}

		elseif ($to) {
			$userList = User::where('created_at', '<', $to)->paginate(5);
		}

		elseif ($from && $to) {
			$userList = User::whereBetween('created_at', [$from, $to])->paginate(5);
		}

		else {
			$userList = User::latest()->paginate(5);
		}
			
		return view('user.userlist',['userList' => $userList]);
	}
}
	