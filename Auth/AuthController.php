<?php 

class AuthController{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthService.php';
    }
    
    public function authenticateEmailInUser($email){    
        $authService = new AuthService();
		return $authService->authenticateEmailInUser($email);
    }
    public function authenticateUsernameInUser($username){
        $authService = new AuthService();
		return $authService->authenticateUsernameInUser($username);
    }
    public function authenticateUsernameEmailInUser($username, $email){
        $authService = new AuthService();
		return $authService->authenticateUsernameEmailInUser($username, $email);
    }
    public function authenticateEmailInRegister($email){
        $authService = new AuthService();
		return $authService->authenticateEmailInRegister($email);
    }
    public function authenticateUsernameInRegister($username){
        $authService = new AuthService();
		return $authService->authenticateUsernameInRegister($username);
    }

    public function authenticateUsernameEmailInRegister($username, $email){
        $authService = new AuthService();
		return $authService->authenticateUsernameEmailInRegister($username, $email);
    }
    


    public function authenticateNewUsername($username){
        $authService = new AuthService();
		return $authService->authenticateNewUsername($username);
    }

    public function authenticateNewEmail($email){
        $authService = new AuthService();
		return $authService->authenticateNewEmail($email);
    }


}

?>