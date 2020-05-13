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
	public function fetchUserByEmail($email){
		$userService = new UserService();
		return $userService->fetchUserByEmail($email);
	}

	public function fetchAllUsers(){
		$userService = new UserService();
		return $userService->fetchAllUsers();
	}
	
	public function clearUser(){
		$userService = new UserService();
		return $userService->clearUser();
	}
	public function updateFirstLastName($username,$first_name,$last_name){
		$userService = new UserService();
		return $userService->updateFirstLastName($username,$first_name,$last_name);
	}
	public function fetchaAllDetailOfUser($username){
		$userService = new UserService();
		return $userService->fetchaAllDetailOfUser($username);
	}
	public function forgotPassword($email){
		$userService = new UserService();
		return $userService->forgotPassword($email);
	}
	
	public function resetPassword($username, $old_password, $new_password){
		$userService = new UserService();
		return $userService->resetPassword($username, $old_password, $new_password);
	}
}

?>