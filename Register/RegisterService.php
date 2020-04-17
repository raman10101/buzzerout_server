<?php 

class RegisterService{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterImp.php';
    }
	
	public function registerUser($first_name,$last_name,$username, $email, $password){
		$registerImp = new RegisterImp();
		return $registerImp->registerUser($first_name,$last_name,$username, $email, $password);
    }   
}

?>