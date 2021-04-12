<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
	public function getEmail()
	{
		return view('auth.passwords.email');
	}

	public function postEmail(Request $request)
	{
		$request->validate([
		'email' => 'required|email|exists:users',
		]);

		$token = Str::random(64);

		DB::table('password_resets')->insert(
		['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
		);

		Mail::send('auth.passwords.verify', ['token' => $token], function($message) use($request){
		$message->from($request->email);
		$message->to($request->email);
		$message->subject('Reset Password Notification');
		});

		return back()->with('message', 'We have e-mailed your password reset link!');
	}
}
