<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/login', function () {
//     dd('');
// });

Route::resource('login','LoginController');

Route::get('users','UserController@index');

// Posts
Route::get('posts','PostController@index');
Route::get('create_post_view','PostController@createView');
Route::post('create_post_confirm','PostController@createConfirm');
Route::post('store_post','PostController@storePost');
Route::post('search','PostController@searchPost');

//Route::get('request_password','ForgetPasswordController@index');

Route::get('/forget_password', 'ForgotPasswordController@getEmail');
Route::post('/forget_password', 'ForgotPasswordController@postEmail');

Route::get('/reset_password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset_password', 'ResetPasswordController@updatePassword');


