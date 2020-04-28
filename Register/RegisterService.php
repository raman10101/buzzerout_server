<?php 

class RegisterService{

    function __construct(){
      require_once dirname(__FILE__) . '/RegisterImp.php';
      require_once  './../User/UserController.php';
    }
	
    public function registerUser($first_name,$last_name,$username, $email, $password){

      $username = strtolower($username);
      $registerImp = new RegisterImp();
      $userController = new UserController();
      // checking account by email in the users table.
      $response = $userController->fetchUserByEmail($email);
      if ($response['error'] == true){
        // checking account by username in the  users table.
        $response = $userController->fetchUserByUsername($username);
        if ($response['error'] == true){
          //  if no user is found by the current username and email in the users table.  
          // check the register table for the username and the email.

          // checking the register table for the email, if found the details are updated.
          $response = $registerImp->fetchUserToRegisterByEmail($first_name, $last_name, $username, $email, $password);
          if ($response['error'] == true){
            // checking for the username in the register table.
            $response = $registerImp->fetchUsernameInRegister($username);
            if ($response['error'] == true){
              //  if all checks are passed then register the user.
              $response= $registerImp->registerUser($first_name,$last_name,$username, $email, $password);
            }
          }
        } 
      }
      return $response;
    }   
      
    public function allUsersToRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->allUsersToRegister();
      }   
    
    public function checkUsername($username){
      $userController = new UserController();
      $response = $userController->fetchUserByUsername($username);
      if ($response['error'] == true){
        $registerImp = new RegisterImp();
        return $registerImp->fetchUsernameInRegister($username);
      }
      else{
        return $response;
      }
    }  
    
    public function clearRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->clearRegister();
      }
}
?>