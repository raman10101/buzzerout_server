<?php

class UsersCollegeService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersCollegeImp.php';
        require_once dirname(__FILE__) . '/UsersCollegeController.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
    public function addCollege($username,  $college_name, $college_place)
    {
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $usersCollegeController = new UsersCollegeController();
            $resp = $userscollegeImp->addCollege($username,  $college_name, $college_place);
            if($resp["error"] == false ){
                $respController = $usersCollegeController->fetchCollegeByUsername($username);
                $resp["colleges"] = $respController["colleges"];
            }
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
    
    public function editCollege($username,  $college_name, $college_place,$college_id){
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $usersCollegeController = new UsersCollegeController();
            $resp=  $userscollegeImp->editCollege($username,  $college_name, $college_place,$college_id);
            if($resp["error"] == false ){
                $respController = $usersCollegeController->fetchCollegeById($username, $college_id);
                $resp["colleges"] = $respController["colleges"];
            }
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }

    public function fetchCollegeByUsername($username)
    {
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $resp =  $userscollegeImp->fetchCollegeByUsername($username);
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
    
    public function fetchCollegeOfAllUsers($username)
    {
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $resp = $userscollegeImp->fetchCollegeOfAllUsers($username);
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
    
    public function fetchCollegeById($username, $college_id)
    {
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $resp = $userscollegeImp->fetchCollegeById($username, $college_id);
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
    
    public function deleteCollegeDetailsById($id, $username)
    {
        $resp = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $resp = $userscollegeImp->deleteCollegeDetailsById($id);
        }
        else{
            $resp["error"] = true;
            $resp["message"] = "User Not Found";
        }
        return $resp;
    }
}
