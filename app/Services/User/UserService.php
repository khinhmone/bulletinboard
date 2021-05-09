<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function getUserList()
  {
    return $this->userDao->getUserList();
  }

  public function getUserProfile()
  {
    return $this->userDao->getUserProfile();
  }

  public function saveUserConfirm(Request $request)
  {
    return $this->userDao->saveUserConfirm($request);
  }

  public function saveUser(Request $request)
  {
    return $this->userDao->saveUser($request);
  }

  public function getUserById($id)
  {
    return $this->userDao->getUserById($id); 
  }

  public function updateUserConfirm($id, Request $request)
  {
    return $this->userDao->updateUserConfirm($id, $request);
  }

  public function updateUser($id, Request $request)
  {
    return $this->userDao->updateUser($id, $request); 
  }

  public function deleteUser($id)
  {
    return $this->userDao->deleteUser($id); 
  }

  public function searchUser($name, $email, $from, $to)
  {
    return $this->userDao->searchUser($name, $email, $from, $to); 
  }

  public function changepassword($request)
  {
    return $this->userDao->changepassword($request); 
  }
}
