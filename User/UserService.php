<?php

class UserService
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/UserImp.php';
    require_once dirname(__FILE__) . '/UserController.php';
    require_once '../Profile/ProfileController.php';
    require_once '../Auth/AuthController.php';
    require_once '../Feed/FeedController.php';
    require_once '../UsersWork/UsersWorkController.php';
    require_once '../UsersCollege/UsersCollegeController.php';
    require_once '../UsersSocial/UsersSocialController.php';
    require_once '../Details/UserdetailController.php';
    require_once '../Follow/FollowController.php';
    require_once '../Profile/ProfileController.php';
  }

  public function loginUserWithUsername($username,  $password)
  {
    $userImp = new UserImp();

    $authController = new AuthController();
    $usercontroller = new UserController();
    $feedController = new FeedController();
    $followController = new FollowController();
    $profileController = new ProfileController();
    $response = array();

    if ($authController->authenticateUsernameInUser($username)["error"] == false) {

      $response = $userImp->loginUserWithUsername($username,  $password);
      if ($response["error"] == false) {
        $newResponse = $usercontroller->fetchaAllDetailOfUser($username);
        $response["details"] = array();
        if ($newResponse["error"] == false) {
          $response["details"] = $newResponse["details"];
        }
        $feedResp = $feedController->fetchFeedByRole($response["user"]["role"]);
        $response['feed'] = $feedResp['feed'];
        unset($response['user']['role']);
        $response['followers'] = array();
        $response['following'] = array();
        $followingResp = $followController->fetchFollowing($username);
        if($followingResp['error'] == false){
          for ($i = 0; $i < count($followingResp['following']); $i++) {
            $response['following'][$i] = array();
            $response['following'][$i]["name"] = $followingResp['following'][$i];
            $resp = $profileController->fetchProfileOfUser($username);
            if ($resp['error'] == false){
              $response['following'][$i]['image'] = $resp['profile_detail']['user_profile_image'];
            }
          }
        }
        $followerResp = $followController->fetchFollowedBy($username);
        if($followerResp['error'] == false){
          for ($i = 0; $i < count($followerResp['followers']); $i++) {
            $response['followers'][$i] = array();
            $response['followers'][$i]["name"] = $followerResp['followers'][$i];
            $resp = $profileController->fetchProfileOfUser($username);
            if ($resp['error'] == false){
              $response['followers'][$i]['image'] = $resp['profile_detail']['user_profile_image'];
            }
          }
        }
      }
    } else {
      $response["error"] = true;
      $response["message"] = "User Not Found";
    }
    return $response;
  }

  public function loginUserWithEmail($username,  $password)
  {
    $userImp = new UserImp();
    $response = $userImp->loginUserWithEmail($username,  $password);
    $usercontroller = new UserController();
    if ($response['error'] == false) {
      $profileController = new ProfileController();
      $resp = $usercontroller->fetchaAllDetailOfUser($username);
      $response["user"] = $resp["user"];
    }
    return $response;
  }
  
  public function fetchUserByUsername($username)
  {
    $userImp = new UserImp();
    return $userImp->fetchUserByUsername($username);
  }
  public function fetchUserByEmail($username, $email)
  {
    $userImp = new UserImp();
    return $userImp->fetchUserByEmail($username, $email);
  }

  public function fetchAllUsers($username)
  {
    $userImp = new UserImp();
    return $userImp->fetchAllUsers($username);
  }

  public function clearUser($username)
  {
    $userImp = new UserImp();
    return $userImp->clearUser($username);
  }


  public function updateFirstLastName($username, $first_name, $last_name)
  {
    $userImp = new UserImp();
    $userController = new UserController();
    $resp =  $userImp->updateFirstLastName($username, $first_name, $last_name);
    if ($resp["error"] == false) {
      $respController = $userController->fetchUserByUsername($username);
      if ($respController["error"] == false) {
        $resp["user"] = $respController["user"];
      } else {
        $resp["error"] = true;
        $resp["message"] = "User Not Found";
      }
    }
    return $resp;
  }
  public function fetchaAllDetailOfUser($username)
  {

    $authController = new AuthController();
    $profilecontroller = new ProfileController();
    $detailController = new UserdetailController();
    $workcontroller = new UsersWorkController();
    $placeController = new PlacesController();
    $userscollegeController = new UsersCollegeController();
    $userssocialController = new UsersSocialController();

    $response = array();

    if ($authController->authenticateUsernameInUser($username)["error"] == false) {
    
      $response["error"] = false;
      $response["details"] = array();
      $response['details']['college'] = array();
      $response['details']['socialMedia'] = array();
      $response['details']['works'] = array();
      $response['details']['city'] = array();
      $response["details"]["profile"] = array();
      $response["details"]["user_details"] = array();

      $temp = $profilecontroller->fetchProfileOfUser($username);
      if ($temp['error'] == false) {
        $response["details"]["profile"] = $temp["profile_detail"];
      }
      $temp = $detailController->fetchUserDetail($username);
      if ($temp['error'] == false) {
        $response["details"]["user_details"] = $temp["userdetails"];
      }
      $temp = $workcontroller->fetchWorkByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['works'] = $temp['works'];
      }
  
      $temp = $placeController->fetchPlacesOfUser($username);

      if ($temp['error'] == false) {
        $response['details']['city'] = $temp['places'];
      }

      $temp = $userscollegeController->fetchCollegeByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['college'] = $temp['colleges'];
      }

      $temp = $userssocialController->fetchSocialDetailsByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['socialMedia'] = $temp['social_accounts_details'];
      }

    } else {
      $response["error"] = true;
      $response["message"] = "User Not Found";
    }

    return $response;
  }

  public function forgotPassword($username, $email)
  {
    $userImp = new UserImp();
    return $userImp->forgotPassword($username, $email);
  }
  
  public function resetPassword($username, $old_password, $new_password)
  {
    $authController = new AuthController();
    $userImp = new UserImp();
    $userController = new UserController();
    $response = array();
    if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $response = $userController->fetchUserByUsername($username);
      if($response['error'] == false){
        if($response['user']['password'] == $old_password){
          $response =  $userImp->resetPassword($username, $old_password, $new_password);
        }
        else{
          $response['error'] = true;
          $response['message'] = "old password is wrong.";
        }
      }
      else{
        $response['error'] = true;
        $response['message'] = "User not found";
      }
    }
    else {
      $response["error"] = true;
      $response["message"] = "User Not Found";
    }
    return $response;
  }
}
?>