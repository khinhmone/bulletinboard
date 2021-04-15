<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
                return redirect('posts');
            }
    
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'password'))->withErrors([
                'Email or password incorrect',
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('user/login');
    }
}
