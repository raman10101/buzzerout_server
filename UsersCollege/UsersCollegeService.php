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
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userscollegeImp = new UsersCollegeImp();
            $usersCollegeController = new UsersCollegeController();
            $resp=  $userscollegeImp->editCollege($username,  $college_name, $college_place,$college_id);
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

    public function fetchCollegeByUsername($username)
    {
        $userscollegeImp = new UsersCollegeImp();
        return $userscollegeImp->fetchCollegeByUsername($username);
    }
    
    public function deleteCollegeDetailsById($id, $username)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $userscollegeImp = new UsersCollegeImp();
        return $userscollegeImp->deleteCollegeDetailsById($id);
    }

}
