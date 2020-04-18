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
	// Fethc User By Username

	// Fetch User By Email

	// Fetch all feeds of a user by Username

}

?>