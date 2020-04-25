<?php

use Slim\Middleware\Flash;

class ProfileService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/ProfileImp.php';
    }
    public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
    {
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
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createEmptyProfileOfUser($username);
    }
    public function updateMobileAddress($username, $mobile, $address)
    {
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

    public function updateDobGender($username, $dob, $gender)
    {
        $ProfileImp = new ProfileImp();
        $profileController=new ProfileController();
        $response = $profileController->fetchProfileOfUser($username);
        $resp = array();
        if ($response['error'] == true){
            $resp = $ProfileImp->createEmptyProfileOfUser($username);
        }
        $resp = $ProfileImp->updateDobGender($username, $dob, $gender);
        if($resp["error"] == false){
            return $profileController->fetchProfileOfUser($username);
        }
        return $resp; 
    }
}
