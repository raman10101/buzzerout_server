<?php 

class RegisterService{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterImp.php';
    }
	
    public function registerUser($first_name,$last_name,$username, $email, $password){
      $registerImp = new RegisterImp();
      return $registerImp->registerUser($first_name,$last_name,$username, $email, $password);
      }   
      
    public function allUsersToRegister(){
      $registerImp = new RegisterImp();
      return $registerImp->allUsersToRegister();
      }   
    
    public function checkUsername($username){
      $registerImp = new RegisterImp();
      return $registerImp->checkUsername($username);
      } 
}

?>