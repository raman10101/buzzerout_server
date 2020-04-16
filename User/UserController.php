<?php 

class UserController{

    function __construct(){
        require_once dirname(__FILE__) . '/UserService.php';
    }

	

	public function loginUser($username,  $password){
		$userService = new UserService();
		return $userService->loginUser($username,  $password);
	}

}

?>