<?php 

class RegisterImp{

    function __construct(){
        require_once dirname(__FILE__) . '/RegisterQuery.php';
	}
	
	public function registerUser($first_name,$last_name,$username, $email, $password, $role){
		$registerQuery = new RegisterQuery();
		return $registerQuery->registerUser($first_name,$last_name,$username, $email, $password, $role);
	}
	
	public function allUsersToRegister(){
		$registerQuery = new RegisterQuery();
		return $registerQuery->allUsersToRegister();
	}
	
	public function fetchUsernameInRegister($username){
		$registerQuery = new RegisterQuery();
		return $registerQuery->fetchUsernameInRegister($username);
	}
	
	public function fetchUserToRegisterByEmail($email){
		$registerQuery = new RegisterQuery();
		return $registerQuery->fetchUserToRegisterByEmail($email);
	}
	
	public function updateUserInRegister($first_name, $last_name, $username, $email, $password, $role){
		$registerQuery = new RegisterQuery();
		return $registerQuery->updateUserInRegister($first_name, $last_name, $username, $email, $password, $role);
	}
	
	public function checkForUpdate($email, $username){
		$registerQuery = new RegisterQuery();
		return $registerQuery->checkForUpdate($email, $username);
	}

	public function clearRegister(){
		$registerQuery = new RegisterQuery();
		return $registerQuery->clearRegister();
	}

}

?>