<?php 

class RegisterService{

    function __construct(){
      require_once dirname(__FILE__) . '/RegisterImp.php';
    }
	
    public function registerUser($first_name,$last_name,$username, $email, $password){

      $username = strtolower($username);

      $registerImp = new RegisterImp();
      $response = $registerImp->fetchUserByEmail($email);
      
      if ($response['error'] == false){
      // Make fetchUserByUserName (Users)
      // Chekc That Also 

      // Object- 
      // 1. Users Table - Username, Email
      // 2. Register Username, email  -> Update

        $response = $registerImp->fetchUserToRegisterByEmail($first_name, $last_name, $username, $email, $password);
        if ($response['error'] == false){
          return $registerImp->registerUser($first_name,$last_name,$username, $email, $password);
        }
        else{
          return $response;
        }
      }
      else{
        return $response;
      } 
    }   
      
    public function allUsersToRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->allUsersToRegister();
      }   
    
    public function checkUsername($username){
      $registerImp = new RegisterImp();
      
      // User ->fetchUserByUsername

      // Register
      return $registerImp->checkUsername($username);

    }  
    
    public function clearRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->clearRegister();
      }
}
?>