<?php

class RegisterService
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/RegisterImp.php';
    require_once  './../User/UserController.php';
    require_once  './../Utils/UtilsController.php';
  }
  
  public function registerUser($first_name, $last_name, $username, $email, $password, $role)
  {
    
    $registerImp = new RegisterImp();
    $userController = new UserController();
    // $utilsController = new UtilsController();
    // $response = $utilsController->lowerCase($username);
    $response = array();
    $response["error"] = false;
    if($response['error'] == false){
      // $response = $utilsController->parseUsernmae($username);
      $response["error"] = false;
      if ($response['error'] == true){
        return $response;
      }
      else{
        //Decrypt the password coming from frontend.
        // Encrypt the password again.
        // Proceeed to register if everything is ok.
        $response = $userController->fetchUserByEmail($email);

        if ($response['error'] == true) {
          // checking account by username in the  users table.
          $response = $userController->fetchUserByUsername($username);
          if ($response['error'] == true) {
            //  if no user is found by the current username and email in the users table.  
            // check the register table for the username and the email.

            // checking the register table for the email, if found the details are updated.
            $response = $registerImp->fetchUserToRegisterByEmail($email);
            if ($response['error'] == true) {


              // checking for the username in the register table.
              $response = $registerImp->fetchUsernameInRegister($username);
              if ($response['error'] == true) {
                //  if all checks are passed then register the user.
                $response = $registerImp->registerUser($first_name, $last_name, $username, $email, $password, $role);

              } else {
                $response['error'] = true;
                $response['message'] = "Username already Taken";
              }
            } 
            else {
              $response = $registerImp->checkForUpdate($email, $username);
              if ($response['error'] == true) {

                $response = $registerImp->updateUserInRegister($first_name, $last_name, $username, $email, $password, $role);
              } else {
                $response['error'] = true;
                $response['message'] = "Username Already Taken";
              }
            }
          } else {
            $response["error"] = true;
            $response["message"] = "Username Already Taken";
          }
        } else {
          $response["error"] = true;
          $response["message"] = "An account already exists with same email";
        }
        return $response;
        }
      }
    /**
     * TODO : Use Utils For Checking Password
     *        Use a single function like Utils.ParsePassWord($password)
     *        This function will :-
     *        1. Decrypt The Password Coming From Front End
     *        2. Check For Length of the function (8<L<16)
     *        3. Encrypt The Password To Store In The Database
     *        4. Password Must Contain Uppercase, Lowercase, Number, and Alphabet
     */


    // checking account by email in the users table.
  }

  public function allUsersToRegister()
  {
    $registerImp = new RegisterImp();
    return $registerImp->allUsersToRegister();
  }

  public function checkUsername($username)
  {
    $userController = new UserController();
    $response = $userController->fetchUserByUsername($username);
    if ($response['error'] == true) {
      $registerImp = new RegisterImp();
      return $registerImp->fetchUsernameInRegister($username);
    } else {
      return $response;
    }
  }

  public function clearRegister()
  {
    $registerImp = new RegisterImp();
    return $registerImp->clearRegister();
  }
}
