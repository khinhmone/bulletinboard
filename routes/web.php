<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportImportController;

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
  return view('welcome');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@authenticate');
    Route::get('/logout', 'LoginController@logout');
});

// user list
Route::get('users','User\UserController@users');

// user profile
Route::get('user_profile','User\UserController@userProfile');

// create user
Route::get('create_user_view','User\UserController@createUser');
Route::post('create_user_confirm','User\UserController@createUserConfirm');
Route::post('store_user','User\UserController@storeUser');

// edit and update user
Route::get('edit_user_view/{id}','User\UserController@editUser');
Route::post('edit_user_confirm/{id}','User\UserController@editUserConfirm');
Route::post('update_user/{id}','User\UserController@updateUser');

// delete user
Route::get('delete_user/{id}','User\UserController@deleteUser');

// search user
Route::post('user_search/','User\UserController@searchUser');

// change_password
Route::get('change_password_view','User\UserController@changePasswordView');
Route::post('change_password','User\UserController@changePassword');

// post list
Route::get('posts','Post\PostController@index');

// create post
Route::get('create_post_view','Post\PostController@createPost');
Route::post('create_post_confirm','Post\PostController@createPostConfirm');
Route::post('store_post','Post\PostController@storePost');

// edit and update post
Route::get('edit_post_view/{id}','Post\PostController@editPost');
Route::post('edit_post_confirm/{id}','Post\PostController@editPostConfirm');
Route::post('update_post/{id}','Post\PostController@updatePost');

// delete post
Route::get('delete_post/{id}','Post\PostController@deletePost');

// search post
Route::post('search','Post\PostController@searchPost');

// upload_csv_view
Route::get('upload_csv_view','Post\PostController@uploadCSV');

/*** Password ***/
/*-----------*/

Route::get('/forget_password', 'ForgotPasswordController@getEmail');
Route::post('/forget_password', 'ForgotPasswordController@postEmail');

Route::get('/reset_password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset_password', 'ResetPasswordController@updatePassword');

// import and export
Route::get('file-import-export', [ExportImportController::class, 'fileImportExport']);
Route::post('file-import', [ExportImportController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ExportImportController::class, 'fileExport'])->name('file-export');

