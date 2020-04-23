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
    public function updateMobileAddress($username, $mobile, $address)
    {
        $ProfileImp = new ProfileImp();
        $profileController=new ProfileController();
        $newResponse = array();
        $response=$ProfileImp->updateMobileAddress($username, $mobile, $address);
        if($response["error"]==false){
            $newResponse["error"] = $response["error"];
            $newResponse["message"] = $response["message"];

            $temp=$profileController->fetchProfileOfUser($username);
            $newResponse["updated_detail"]=$temp["profile_detail"];


        }
        return $newResponse;
    }
    public function updateDobGender($username, $dob, $gender)
    {
        $ProfileImp = new ProfileImp();
        $profileController=new ProfileController();
        $newResponse = array();
        $temp = array();
        $response=$ProfileImp->updateDobGender($username, $dob, $gender);
        if($response["error"]==false){
            $newResponse["error"] = $response["error"];
            $newResponse["message"] = $response["message"];
            $temp=$profileController->fetchProfileOfUser($username);
            $newResponse["updated_detail"]=$temp["profile_detail"];
        }
        return $newResponse;
    }
}
