<?php

class UsersSocialService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersSocialController.php';
        require_once dirname(__FILE__) . '/UsersSocialImp.php';
        require_once  './../User/UserController.php';
        require_once  './../Config/Connect.php';
        require_once '../Auth/AuthController.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }
    public function addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userssocialImp = new UsersSocialImp();
            $usersSocialController = new UsersSocialController();
            $response = $usersSocialController->fetchSocialDetailsByUsername($username);
            if ($response["error"] == false) {
                $response = $userssocialImp->updateSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
            } else {
                $response = $userssocialImp->addSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
            }
        }else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response;
    }

    public function fetchSocialDetailsByUsername($username)
    {
        $userssocialImp = new UsersSocialImp();
        return $userssocialImp->fetchSocialDetailsByUsername($username);
    }

    public function deleteSocialDetailsById($id, $username)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $userssocialImp = new UsersSocialImp();
        return $userssocialImp->deleteSocialDetailsById($id);
    }
}
