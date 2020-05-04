<?php

class RegisterService
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/RegisterImp.php';
    require_once  './../User/UserController.php';
    require_once  './../Utils/UtilsController.php';
    require_once  './../Auth/AuthController.php';
  }

  public function registerUser($first_name, $last_name, $username, $email, $password, $role)
  {

    /// Call All controllers
    $registerImp = new RegisterImp();
    $authController = new AuthController();

    $response = array();


    if ($authController->authenticateEmailInUser($email)["error"] == true) {
      if ($authController->authenticateUsernameInUser($username)["error"] == true) {
        if ($authController->authenticateEmailInRegister($email)["error"] == true) {
          if ($authController->authenticateUsernameInRegister($username)["error"] == true) {
            $response = $registerImp->registerUser($first_name, $last_name, $username, $email, $password, $role);
          } else {
            $response["error"] = true;
            $response["message"] = "Username is already Taken";
          }
        } else {
          if ($authController->authenticateUsernameInRegister($username)["error"] == true) {
            $response = $registerImp->updateUserInRegister($first_name, $last_name, $username, $email, $password, $role);
          } else {
            if ($authController->authenticateUsernameEmailInRegister($username, $email)["error"] == true) {
              $response = $registerImp->updateUserInRegister($first_name, $last_name, $username, $email, $password, $role);
            } else {
              $response["error"] = true;
              $response["message"] = "Username is already Taken";
            }
          }
        }
      } else {
        $response["error"] = true;
        $response["message"] = "Username is already Taken";
      }
    } else {
      $response["error"] = true;
      $response["message"] = "Email is already Registered";
    }

    return $response;
  }


  public function activateRegisterUserLink($email){
    $registerImp = new RegisterImp();
    $authController = new AuthController();
    $response = array();
    if($authController->authenticateEmailInRegister($email)["error"] == false){
      $response = $registerImp->activateRegisterUserLink($email);
    }else{
      $response["error"] = true;
      $response["message"] = "Invalid Email Id";
    }
    return $response;
  }

  public function allUsersToRegister()
  {
    $registerImp = new RegisterImp();
    return $registerImp->allUsersToRegister();
  }

  public function clearRegister()
  {
    $registerImp = new RegisterImp();
    return $registerImp->clearRegister();
  }
}
