<?php

namespace App\Contracts\Services\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
  //get user list
  public function getUserList();
  public function saveUser(Request $request);
  public function getUserById($id);
  public function updateUser($id, Request $request);
  public function deleteUser($id);
  public function searchUser($name, $email, $from, $to);
}
