<?php 

class RegisterController{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterService.php';
    }
	public function registerUser($first_name,$last_name,$username, $email, $password){
		$registerService = new RegisterService();
		return $registerService->registeruser($first_name,$last_name,$username, $email, $password);
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