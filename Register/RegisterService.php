<?php 

class RegisterService{

    function __construct(){
      require_once dirname(__FILE__) . '/RegisterImp.php';
    }
	
    public function registerUser($first_name,$last_name,$username, $email, $password){
      $registerImp = new RegisterImp();
      $response = $registerImp->fetchUserByEmail($email);
      if ($response['error'] == false){
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
      return $registerImp->checkUsername($username);
    }  
    
    public function clearRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->clearRegister();
      }
}
?>