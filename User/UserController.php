<?php 

class UserController{

    function __construct(){
        require_once dirname(__FILE__) . '/UserService.php';
    }

	public function loginUserWithUsername($username,  $password){
		$userService = new UserService();
		return $userService->loginUserWithUsername($username,  $password);
	}
	
	public function loginUserWithEmail($username,  $password){
		$userService = new UserService();
		return $userService->loginUserWithEmail($username,  $password);
	}
	
	public function fetchUserByUsername($username){
		$userService = new UserService();
		return $userService->fetchUserByUsername($username);
	}
	
	public function fetchAllUsers(){
		$userService = new UserService();
		return $userService->fetchAllUsers();
	}
	
	public function clearUser(){
		$userService = new UserService();
		return $userService->clearUser();
	}

















	
}

?>