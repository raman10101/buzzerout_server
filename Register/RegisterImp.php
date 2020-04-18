<?php 

class RegisterImp{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterQuery.php';
	}
	
	public function registerUser($first_name,$last_name,$username, $email, $password){
		$registerQuery = new RegisterQuery();
		return $registerQuery->registerUser($first_name,$last_name,$username, $email, $password);
	}
	
	public function allUsersToRegister(){
		$registerQuery = new RegisterQuery();
		return $registerQuery->allUsersToRegister();
	}

}

?>