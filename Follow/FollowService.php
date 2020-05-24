<?php

class FollowService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FollowImp.php';
        require_once  './../User/UserController.php';
        require_once  './../Follow/FollowController.php';
        require_once  './../Profile/ProfileController.php';
    }
    public function fetchFollowing($username)
    {
        $followImp = new FollowImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $followImp->fetchFollowing($username);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
    public function newFollow($username, $by, $to)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($by);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn first";
                return $userResponse;
            }

            $followImp = new FollowImp();
            $followController = new FollowController();
            $profileController = new ProfileController();

            $response = array();
            // check if an user is already follwed.
            $resp = $followingResp = $followController->fetchFollowing($by);
            if (in_array($to, $resp['following'])) {
                $response['error'] = true;
                $response['message'] = "the user is already followed";
            } else {
                $response =  $followImp->newFollow($by, $to);
                if ($response['error'] == false) {
                    $response['following'] = array();
                    $followingResp = $followController->fetchFollowing($by);
                    if (count($followingResp['following']) > 0) {
                        for ($i = 0; $i < count($followingResp['following']); $i++) {
                            $response['following'][$i] = array();
                            $response['following'][$i]["name"] = $followingResp['following'][$i];
                            $resp = $profileController->fetchProfileOfUser($by);
                            if ($resp['error'] == false) {
                                $response['following'][$i]['image'] = $resp['profile_detail']['user_profile_image'];
                            }
                        }
                    } else {
                        $response['error'] = false;
                        $response['message'] = "no following found";
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = 'error in following the user';
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function fetchFollowedBy($username)
    {
        $followImp = new FollowImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $followImp->fetchFollowedBy($username);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
    public function deleteFollowing($username, $to)
    {
        //Check Username
        $user = new UserController();
        $followImp = new FollowImp();
        $followController = new FollowController();
        $profileController = new ProfileController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn first";
                return $userResponse;
            }
            $response = array();
            // check if an user is already follwed.
            $resp = $followingResp = $followController->fetchFollowing($username);
            if (!in_array($to, $resp['following'])) {
                $response['error'] = true;
                $response['message'] = "You do not follow the user, Invalid operation";
            } else {
                $response =  $followImp->deleteFollowing($username, $to);
                if ($response['error'] == false) {
                    $response['following'] = array();
                    $followingResp = $followController->fetchFollowing($username);
                    if (count($followingResp['following']) > 0) {
                        for ($i = 0; $i < count($followingResp['following']); $i++) {
                            $response['following'][$i] = array();
                            $response['following'][$i]["name"] = $followingResp['following'][$i];
                            $resp = $profileController->fetchProfileOfUser($username);
                            if ($resp['error'] == false) {
                                $response['following'][$i]['image'] = $resp['profile_detail']['user_profile_image'];
                            }
                        }
                    } else {
                        $response['error'] = false;
                        $response['message'] = "no following found";
                    }
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function deleteFollower($username, $by)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn first";
                return $userResponse;
            }
            $followImp = new FollowImp();
            return $followImp->deleteFollower($username, $by);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
    public function deleteUserConnections($username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn first";
                return $userResponse;
            }
            $followImp = new FollowImp();
            return $followImp->deleteUserConnections($username);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
    public function deleteAllFollow($username)
    {
        $followImp = new FollowImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $followImp->deleteAllFollow();
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
    public function fetchAllFollow($username)
    {
        $followImp = new FollowImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $followImp->fetchAllFollow();
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
}
