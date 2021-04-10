<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function store(Request $request)
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
                // if successful -> redirect forward
                if (Auth::user()->type == 1) {
                    return redirect('users');
                } else {
                	return redirect('users');
                }
            }
    
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'password'))->withErrors([
                'Email or password incorrect',
            ]);
        }
    }    
}
