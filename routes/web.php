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
Route::get('logout','LoginController@logout');

/*** Users ***/
/*-----------*/

// user list
Route::get('users','UserController@users');

// user profile
Route::get('user_profile','UserController@userProfile');

// create user
Route::get('create_user_view','UserController@createUser');
Route::post('create_user_confirm','UserController@createUserConfirm');
Route::post('store_user','UserController@storeUser');

// edit and update user
Route::get('edit_user_view','UserController@editUser');
Route::post('edit_user_confirm','UserController@editUserConfirm');
Route::post('update_userinfo','UserController@updateUser');

/*** Posts ***/
/*-----------*/

// post list
Route::get('posts','PostController@index');

// create post
Route::get('create_post_view','PostController@createPost');
Route::post('create_post_confirm','PostController@createPostConfirm');
Route::post('store_post','PostController@storePost');

// edit and update post
Route::get('edit_post_view/{id}','PostController@editPost');
Route::post('edit_post_confirm/{id}','PostController@editPostConfirm');
Route::post('update_post/{id}','PostController@updatePost');

// delete post
Route::get('delete_post/{id}','PostController@deletePost');

// search post
Route::post('search','PostController@searchPost');


/*** Password ***/
/*-----------*/

Route::get('/forget_password', 'ForgotPasswordController@getEmail');
Route::post('/forget_password', 'ForgotPasswordController@postEmail');

Route::get('/reset_password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset_password', 'ResetPasswordController@updatePassword');


