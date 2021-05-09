<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
	private $userInterface;

	/**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
	public function __construct(UserServiceInterface $userInterface)
	{
		$this->middleware('auth');
		$this->userInterface = $userInterface;
	}

	public function users()
	{
        $userList = $this->userInterface->getUserList();
		return view('user.userlist',['userList' => $userList]);
	}


	public function userProfile()
	{
		$userProfile = $this->userInterface->getUserProfile();
		return $userProfile;
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

		$saveUserConfirm = $this->userInterface->saveUserConfirm($request);
    	return $saveUserConfirm; 
	}

	// store post to db
	public function storeUser(Request $request) 
	{
		$this->userInterface->saveUser($request);
		return redirect('/users')->with('success','User created successfully!');
	}

	// retrieve data for update user form
	public function editUser() 
	{
		$getUserById = $this->userInterface->getUserById(Auth::user()->id);
    	return $getUserById; 
	}

	// show data for update user form
	public function editUserConfirm($id, Request $request) 
	{
		$this->validate(request(),[
			'name'=>'required|unique:users|max:255',
			'email'=>'required',
			'type'=>'required',
			'profile'=>'required',
		]);

		$updateUserConfirm = $this->userInterface->updateUserConfirm($id, $request);
    	return $updateUserConfirm; 
	}

	// update user data to db
	public function updateUser(Request $request,$id) 
	{
		$this->userInterface->updateUser($id, $request);
		return redirect('/posts')->with('success', 'User updated successfully!');
	}

	// delete user data to db
	public function deleteUser($id) 
	{
		$this->userInterface->deleteUser($id);
		return redirect('users')->with('success','User temporarily deleted!');
	}

	// changePassword
	public function changePasswordView() 
	{
		return view('user.changepassword');
	}

	// changePassword
	public function changePassword(Request $request) 
	{
		$this->validate(request(),[
			'current_password' => 'required',
			'new_password'=>'required|min:8',
			'confirm_new_password'=>'required|min:8|same:new_password',
		]);
		$this->userInterface->changepassword($request); 
        return redirect('posts')->with('success','Password Change successfully!');
	}

	public function searchUser(Request $request) 
	{
		$name = $request->get('name');
	    $email = $request->get('email');
	    $from = $request->get('from');
	    $to = $request->get('to');	    
	    $userList = $this->userInterface->searchUser($name, $email, $from, $to);
	    return view('user.userList',compact('userList'));
	}
}
	