<?php

use Slim\Middleware\Flash;

class ProfileService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/ProfileImp.php';
        require_once  './../User/UserController.php';
        require_once './../Profile/ProfileController.php';
        require_once '../Auth/AuthController.php';
    }
    public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $userResponse = $user->fetchUserByUsername($username);
        if ($userResponse["error"] == true) {
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);}        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital)
    {
        $ProfileImp = new ProfileImp();
        $profileController = new ProfileController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $ProfileImp->updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital);
            if($response['error'] == false){
                $resp = $profileController->fetchProfileOfUser($username);
                $response['profile'] = $resp['profile'];
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }

        return $response;
    }
    public function fetchProfileOfUser($username)
    {
        $ProfileImp = new ProfileImp();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        return $ProfileImp->fetchProfileOfUser($username);}        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    
    public function fetchProfileOfAllUsers($username)
    {
        $ProfileImp = new ProfileImp();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        return $ProfileImp->fetchProfileOfAllUsers($username);}
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function createEmptyProfileOfUser($username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $userResponse = $user->fetchUserByUsername($username);
        if ($userResponse["error"] == true) {
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createEmptyProfileOfUser($username);}        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function updateMobileAddress($username, $mobile, $address)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $userResponse = $user->fetchUserByUsername($username);
        if ($userResponse["error"] == true) {
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        $profileController = new ProfileController();
        $response = $profileController->fetchProfileOfUser($username);
        $resp = array();
        if ($response['error'] == true) {
            $resp = $ProfileImp->createEmptyProfileOfUser($username);
        }
        $resp = $ProfileImp->updateMobileAddress($username, $mobile, $address);
        if ($resp["error"] == false) {
            return $profileController->fetchProfileOfUser($username);
        }
        return $resp;}
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function updateDobGender($username, $dob, $uob, $gender)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response=array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $userResponse = $user->fetchUserByUsername($username);
        if ($userResponse["error"] == true) {
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $ProfileImp = new ProfileImp();
        $profileController = new ProfileController();
        $response = $profileController->fetchProfileOfUser($username);
        $resp = array();
        if ($response['error'] == true) {
            $resp = $ProfileImp->createEmptyProfileOfUser($username);
        }
        $resp = $ProfileImp->updateDobGender($username, $dob, $uob, $gender);
        if ($resp["error"] == false) {
            return $profileController->fetchProfileOfUser($username);
        }
        return $resp;}
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function updateUserTimelineImage($username, $img)
    {
        $authController = new AuthController();
        $ProfileImp = new ProfileImp();
        $user = new UserController();
        
        $profilecontroller = new ProfileController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $ProfileImp->updateUserTimelineImage($username, $img);
            if ($response['error'] == false) {
                $response = $profilecontroller->fetchProfileOfUser($username);
            }
        } else {
            $response['error'] = true;
            $response['msg'] = "user not found";
        }


        return $response;
    }
    public function updateUserProfileImage($username, $img)
    {
        $authController = new AuthController();
        $ProfileImp = new ProfileImp();
        $profilecontroller = new ProfileController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $ProfileImp->updateUserProfileImage($username, $img);
            if ($response['error'] == false) {
                $response = $profilecontroller->fetchProfileOfUser($username);
            }
        } else {
            $response['error'] = true;
            $response['msg'] = "user not found";
        }
        return $response;
    }
    
    public function updateUserWebsiteLink($username, $phone_no, $social_link, $website_url)
    {
        $authController = new AuthController();
        $ProfileImp = new ProfileImp();
        $profileController = new ProfileController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $ProfileImp->updateUserWebsiteLink($username, $phone_no, $social_link, $website_url);
            if($response['error'] == false){
                $resp = $profileController->fetchProfileOfUser($username);
                if($resp['error'] == false){
                    $response['profile'] = $resp['profile'];
                }
            }
        } 
        else {
            $response['error'] = true;
            $response['msg'] = "user not found";
        }
        return $response;
    }
}
