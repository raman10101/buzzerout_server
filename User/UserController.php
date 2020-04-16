<?php 

class UserController{

    function __construct(){
        require_once dirname(__FILE__) . '/UserService.php';
    }

	public function loginUser($username,  $password){
		$userService = new UserService();
		return $userService->loginUser($username,  $password);
	}

	// Fethc User By Username

	// Fetch User By Email

	// Fetch all feeds of a user by Username

}

?>