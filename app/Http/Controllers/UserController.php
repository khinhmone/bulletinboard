<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request){
    	// dd('kkk');
    	$userList = User::latest()->paginate(5);
    	return view('user.userlist',['userList' => $userList]);
    }
}
