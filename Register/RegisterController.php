<?php 

class RegisterController{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterService.php';
	}
	/**
   * Objective :
   * 
   * This function Will Regisetr A Username
   * 
   * Params :
   * 
   * $first_name = First Name Of User
   * $last_name = Last Name Of User
   * $username = Username Of User
   * $email = Email Of User
   * $password = Password Of User
   * 
   * return :
   * 
   * This function will register or update a user, 
   * and successfully Send The Mail Of Registration To User 
   */
  
	public function registerUser($first_name,$last_name,$username, $email, $password, $role){
		$registerService = new RegisterService();
		return $registerService->registeruser($first_name,$last_name,$username, $email, $password, $role);
	}	
	
	public function allUsersToRegister(){
		$registerService = new RegisterService();
		return $registerService->allUsersToRegister();
	}
	
	public function checkUsername($username){
		$registerService = new RegisterService();
		return $registerService->checkUsername($username);
	}
	
	public function clearRegister(){
		$registerService = new RegisterService();
		return $registerService->clearRegister();
    }

}

?>