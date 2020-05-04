<?php 

class AuthImp{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthQuery.php';
    }

    public function authenticateEmailInUser($email){    
        $authQuery = new AuthQuery();
		return $authQuery->authenticateEmailInUser($email);
    }
    public function authenticateUsernameInUser($username){
        $authQuery = new AuthQuery();
		return $authQuery->authenticateUsernameInUser($username);
    }
    public function authenticateUsernameEmailInUser($username, $email){
        $authQuery = new AuthQuery();
		return $authQuery->authenticateUsernameEmailInUser($username, $email);
    }
    public function authenticateEmailInRegister($email){
        $authQuery = new AuthQuery();
		return $authQuery->authenticateEmailInRegister($email);
    }
    public function authenticateUsernameInRegister($username){
        $authQuery = new AuthQuery();
		return $authQuery->authenticateUsernameInRegister($username);
    }

    public function authenticateUsernameEmailInRegister($username, $email){
        $authQuery = new AuthQuery();
		return $authQuery->authenticateUsernameEmailInRegister($username, $email);
    }
    


}
