<?php 

class AuthController{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthService.php';
    }

    public function authUser($username)
    {
        $authService = new AuthService();
		return $authService->authUser($username);
    }
    

}

?>