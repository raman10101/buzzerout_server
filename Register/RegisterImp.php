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
	
	public function fetchUsernameInRegister($username){
		$registerQuery = new RegisterQuery();
		return $registerQuery->fetchUsernameInRegister($username);
	}
	
	public function fetchUserToRegisterByEmail($first_name, $last_name, $username, $email, $password){
		$registerQuery = new RegisterQuery();
		return $registerQuery->fetchUserToRegisterByEmail($first_name, $last_name, $username, $email, $password);
	}
	

	public function clearRegister(){
		$registerQuery = new RegisterQuery();
		return $registerQuery->clearRegister();
	}

}

?>