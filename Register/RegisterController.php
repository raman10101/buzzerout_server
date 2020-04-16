<?php 

class RegisterController{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterService.php';
    }
	public function registerUser($first_name,$last_name,$username, $email, $password){
		$registerService = new RegisterService();
		return $registerService->registeruser($first_name,$last_name,$username, $email, $password);
	}
	
}

?>