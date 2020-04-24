<?php

class UserService
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/UserImp.php';
    require_once dirname(__FILE__) . '/UserController.php';
  }

  public function loginUserWithUsername($username,  $password)
  {
    $userImp = new UserImp();
    return $userImp->loginUserWithUsername($username,  $password);
  }

  public function loginUserWithEmail($username,  $password)
  {
    $userImp = new UserImp();
    return $userImp->loginUserWithEmail($username,  $password);
  }

  public function fetchUserByUsername($username)
  {
    $userImp = new UserImp();
    return $userImp->fetchUserByUsername($username);
  }

  public function fetchAllUsers()
  {
    $userImp = new UserImp();
    return $userImp->fetchAllUsers();
  }

  public function clearUser()
  {
    $userImp = new UserImp();
    return $userImp->clearUser();
  }


  public function updateFirstLastName($username, $first_name, $last_name)
  {
    $userImp = new UserImp();
    $userController = new UserController();
    $resp =  $userImp->updateFirstLastName($username, $first_name, $last_name);
    if($resp["error"] == false){
      $respController = $userController->fetchUserByUsername($username);
      if($respController["error"] == false){
        $resp["user"] = $respController["user"];
      }else{
        $resp["error"] = true;
        $resp["message"] = "User Not Found";
      }
      
    }
    return $resp;
  }
}
