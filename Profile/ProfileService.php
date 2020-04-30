<?php

use Slim\Middleware\Flash;

class ProfileService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/ProfileImp.php';
        require_once  './../User/UserController.php';
    }
    public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);
    }
    public function fetchProfileOfUser($username)
    {
        $ProfileImp = new ProfileImp();
        return $ProfileImp->fetchProfileOfUser($username);
    }
    
    public function createEmptyProfileOfUser($username)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createEmptyProfileOfUser($username);
    }
    public function updateMobileAddress($username, $mobile, $address)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        $profileController=new ProfileController();
        $response = $profileController->fetchProfileOfUser($username);
        $resp = array();
        if ($response['error'] == true){
            $resp = $ProfileImp->createEmptyProfileOfUser($username);
        }
        $resp = $ProfileImp->updateMobileAddress($username, $mobile, $address);
        if($resp["error"] == false){
            return $profileController->fetchProfileOfUser($username);
        }
        return $resp; 
    }

    public function updateDobGender($username, $dob, $uob,$gender)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        $profileController=new ProfileController();
        $response = $profileController->fetchProfileOfUser($username);
        $resp = array();
        if ($response['error'] == true){
            $resp = $ProfileImp->createEmptyProfileOfUser($username);
        }
        $resp = $ProfileImp->updateDobGender($username, $dob, $uob,$gender);
        if($resp["error"] == false){
            return $profileController->fetchProfileOfUser($username);
        }
        return $resp; 
    }
}
