<?php

class UserImp
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/UserQuery.php';
  }

  public function loginUserWithUsername($username,  $password)
  {
    $userQuery = new UserQuery();
    return $userQuery->loginUserWithUsername($username,  $password);
  }

  public function loginUserWithEmail($username,  $password)
  {
    $userQuery = new UserQuery();
    return $userQuery->loginUserWithEmail($username,  $password);
  }

  public function fetchUserByUsername($username)
  {
    $userQuery = new UserQuery();
    return $userQuery->fetchUserByUsername($username);
  }

  public function fetchUserByEmail($username, $email){
		$userQuery = new UserQuery();
		return $userQuery->fetchUserByEmail($username, $email);
	}

  public function fetchAllUsers($username)
  {
    $userQuery = new UserQuery();
    return $userQuery->fetchAllUsers($username);
  }

  public function clearUser($username)
  {
    $userQuery = new UserQuery();
    return $userQuery->clearUser($username);
  }

  public function updateFirstLastName($username, $first_name, $last_name)
  {
    $userQuery = new UserQuery();
    return $userQuery->updateFirstLastName($username, $first_name, $last_name);
  }
  public function forgotPassword($username, $email){
		$userQuery = new UserQuery();
		return $userQuery->forgotPassword($username, $email);
  }
  
  public function resetPassword($username, $old_password, $new_password){
		$userQuery = new UserQuery();
		return $userQuery->resetPassword($username, $old_password, $new_password);
  }
}
