<?php 

class AuthService{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthImp.php';
        require_once  './../User/UserController.php';
        require_once  './../Auth/AuthController.php';
    }

    public function authenticateEmailInUser($email){    
        $authImp = new AuthImp();
        return $authImp->authenticateEmailInUser($email);
    }
    public function authenticateUsernameInUser($username){
        $authImp = new AuthImp();
        return $authImp->authenticateUsernameInUser($username);
    }
    public function authenticateUsernameEmailInUser($username, $email){
        $authImp = new AuthImp();
        return $authImp->authenticateUsernameEmailInUser($username, $email);
    }
    public function authenticateEmailInRegister($email){
        $authImp = new AuthImp();
        return $authImp->authenticateEmailInRegister($email);
    }
    public function authenticateUsernameInRegister($username){
        $authImp = new AuthImp();
        return $authImp->authenticateUsernameInRegister($username);
    }
    public function authenticateUsernameEmailInRegister($username, $email){
        $authImp = new AuthImp();
        return $authImp->authenticateUsernameEmailInRegister($username, $email);
    }


    public function authenticateNewUsername($username){
        $response = array();
        $authController = new AuthController();
        if($authController->authenticateUsernameInUser($username)["error"] == false){
            $response["error"] = true;
        }else{
            if($authController->authenticateUsernameInRegister($username)["error"] == false){
                $response["error"] = true;
            }else{
                $response["error"] = false;
            }
        }

        return $response;
    }

    public function authenticateNewEmail($email){
        $response = array();
        $authController = new AuthController();
        if($authController->authenticateEmailInUser($email)["error"] == false){
            $response["error"] = true;
            $response["message"] = "Email Already Taken";
            $response["user"] = true;
            $response["register"] = false;
        }else{
            if($authController->authenticateEmailInRegister($email)["error"] == false){
                $response["error"] = true;
                $response["register"] = true;
                $response["user"] = false;

            }else{
                $response["error"] = false;
            }
        }

        return $response;
    }
    
}
