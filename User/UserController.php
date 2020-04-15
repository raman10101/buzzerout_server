<?php 

class UserController{

    function __construct(){
        require_once dirname(__FILE__) . '/UserService.php';
    }
	public function registerUser($first_name,$last_name,$username, $email, $password){
		$userService = new UserService();
		return $userService->registerUser($first_name,$last_name,$username, $email, $password);
	}
	

	public function loginUser($username,  $password){
		$userService = new UserService();
		return $userService->loginUser($username,  $password);
	}


	public function fetchProfileOfUser($username){
		$userService = new UserService();
		return $userService->fetchProfileOfUser($username);
	}


}

?>