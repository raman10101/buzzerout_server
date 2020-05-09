<?php

class UsersWorkService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersWorkImp.php';
        require_once dirname(__FILE__) . '/UsersWorkController.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
    public function addWork($username,  $work_place, $work_profile)
    {
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $usersworkImp = new UsersWorkImp();
            $usersWorkController = new UsersWorkController();
            $resp =  $usersworkImp->addWork($username,  $work_place, $work_profile);
            if($resp["error"] == false){
                $respController = $usersWorkController->fetchWorkByUsername($username);
                $resp["works"] = $respController["works"];
            }
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
    public function editWork($username,  $work_place, $work_profile,$work_id){
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $usersworkImp = new UsersWorkImp();
            $usersWorkController = new UsersWorkController();
            $resp = $usersworkImp->editWork($username,  $work_place, $work_profile,$work_id);
            if($resp["error"] == false){
                $respController = $usersWorkController->fetchWorkByUsername($username);
                $resp["works"] = $respController["works"];
            }
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
	}
    
    public function fetchWorkByUsername($username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $usersworkImp = new UsersWorkImp();
            $response = $usersworkImp->fetchWorkByUsername($username);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }
    
    public function fetchWorkOfAllUsers($username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $usersworkImp = new UsersWorkImp();
            $response = $usersworkImp->fetchWorkOfAllUsers($username);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }

    public function deleteWorkDetailsById($id, $username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $usersworkImp = new UsersWorkImp();
            $response = $usersworkImp->deleteWorkDetailsById($id);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }

}
