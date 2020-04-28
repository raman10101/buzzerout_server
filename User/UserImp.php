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

  public function fetchUserByEmail($email){
		$userQuery = new UserQuery();
		return $userQuery->fetchUserByEmail($email);
	}

  public function fetchAllUsers()
  {
    $userQuery = new UserQuery();
    return $userQuery->fetchAllUsers();
  }

  public function clearUser()
  {
    $userQuery = new UserQuery();
    return $userQuery->clearUser();
  }

  public function updateFirstLastName($username, $first_name, $last_name)
  {
    $userQuery = new UserQuery();
    return $userQuery->updateFirstLastName($username, $first_name, $last_name);
  }
  public function forgotPassword($email){
		$userQuery = new UserQuery();
		return $userQuery->forgotPassword($email);
	}
}
