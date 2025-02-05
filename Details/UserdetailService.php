<?php

use Slim\Middleware\Flash;

class UserdetailService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UserdetailImp.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
    public function createUserDetail($username, $about_you, $other_name, $fav_quote)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $UserdetailImp = new UserdetailImp();
            $UserDetailController=new UserdetailController();
            $response = $UserdetailImp->createUserDetail($username, $about_you, $other_name, $fav_quote);
            if($response["error"] == false){
                $respController = $UserDetailController->fetchUserDetail($username);
                $response["user_details"] = $respController["user_details"];
            }
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response;
    }
    public function fetchUserDetail($username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $UserdetailImp = new UserdetailImp();
            $response = $UserdetailImp->fetchUserDetail($username);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response;  
    }
    
    public function fetchUserDetailOfAllUsers($username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $UserdetailImp = new UserdetailImp();
            $response = $UserdetailImp->fetchUserDetailOfAllUsers($username);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }

    public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $UserdetailImp = new UserdetailImp();
            $UserDetailController = new UserdetailController();
            $response=$UserdetailImp->updateUserDetails($username, $about_you, $other_name, $fav_quote);
            if($response["error"]==false){
                $respController = $UserDetailController->fetchUserDetail($username);
                if($respController['error'] == false){
                    $response["user_details"] = $respController["user_details"];
                    unset($response["user_details"]['id']);
                    unset($response["user_details"]['username']);
                }
                else{
                    $resp = $UserDetailController->createUserDetail($username, $about_you, $other_name, $fav_quote);
                    if($resp['error'] == false){
                        $response["user_details"] = $resp["user_details"];
                        unset($response["user_details"]['id']);
                        unset($response["user_details"]['username']);
                        $response['message'] = "user details created";
                    }
                    else{
                        $response['message'] = "error in creating the user details.";
                    }
                }
            }
            else{
                return $UserDetailController->createUserDetail($username, $about_you, $other_name, $fav_quote);
            }
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }

    // public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
    // {
    //     $response = array();
    //     //Check Username
    //     $authController = new AuthController();
    //     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
    //         $UserdetailImp = new UserdetailImp();
    //         $UserDetailController =new UserdetailController();
    //         $userDetailFetchResp = $UserDetailController->fetchUserDetail($username);
    //         if($userDetailFetchResp["error"] == false){
    //             $response=$UserdetailImp->updateUserDetails($username, $about_you, $other_name, $fav_quote);
    //             if($response["error"]==false){
    //                 $respController = $UserDetailController->fetchUserDetail($username);
    //                 $response["userdetails"] = $respController["userdetails"];
    //             }
    //         }
    //         else{
    //             return $UserDetailController->createUserDetail($username, $about_you, $other_name, $fav_quote);
    //         }
    //     }
    //     else {
    //         $response["error"] = true;
    //         $response["message"] = "User Not Found";
    //       }
    //     return $response; 
    // }

}
