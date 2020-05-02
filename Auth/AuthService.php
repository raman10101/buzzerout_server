<?php 

class AuthService{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthImp.php';
        require_once  './../User/UserController.php';
    }
    
    public function authUser($username)
    {
        $authImp = new AuthImp();
        $response = $authImp->authUser($username);
        if ($response['error'] == false){
            $user = new UserController();
            $userResponse = $user->fetchUserByUsername($username);
            if($userResponse["error"] == false){
                $response['error'] = false;
                $response['message'] = "user is authenticated";
            }
            else{
                $response['error'] = true;
                $response["message"] = "User not authenticated";
            }
        }
        else{
            $response['error'] = true;
            $response["message"] = "User not authenticated";
        }
        return $response;
    }
}
