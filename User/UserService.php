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
        $response["details"] = array();
        $newResponse = $usercontroller->fetchaAllDetailOfUser($username);
        if ($newResponse["error"] == false) {
          $response["details"] = $newResponse["details"];
        }
        $feedResp = $feedController->fetchFeedByRole($username, $response["user"]["role"]);
        $response['feed'] = $feedResp['feeds'];
        $resp = $feedController->fetchCollectionByuser($username);
        if ($resp['error'] == false){
          $response['hide_buzz'] = $resp['hide_buzz'];
          $response['shared_buzz'] = $resp['shared_buzz'];
          $response['save_buzz'] = $resp['save_buzz'];
        }
        else{
          $response['feed_collection'] = "error in fetching collection feeds of user"; 
        }
        $response['followers'] = array();
        $response['following'] = array();
        $followingResp = $followController->fetchFollowing($username);
        if($followingResp['error'] == false){
          for ($i = 0; $i < count($followingResp['following']); $i++) {
            $response['following'][$i] = array();
            $response['following'][$i]["name"] = $followingResp['following'][$i];
            $resp = $profileController->fetchProfileOfUser($followingResp['following'][$i]);
            if ($resp['error'] == false){
              $response['following'][$i]['image'] = $resp['profile']['user_profile_image'];
            }
            else{
              $response['following_image'] = "error in fetching the profile image of following";
            }
          }
        }
        $followerResp = $followController->fetchFollowedBy($username);
        if($followerResp['error'] == false){
          for ($i = 0; $i < count($followerResp['followers']); $i++) {
            $response['followers'][$i] = array();
            $response['followers'][$i]["name"] = $followerResp['followers'][$i];
            $resp = $profileController->fetchProfileOfUser($followerResp['followers'][$i]);
            if ($resp['error'] == false){
              $response['followers'][$i]['image'] = $resp['profile']['user_profile_image'];
            }
            else{
              $response['follower_image'] = "error in fetching the profile image of follower";
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
        $response["details"]["profile"] = $temp["profile"];
      }
      $temp = $detailController->fetchUserDetail($username);
      if ($temp['error'] == false) {
        $response["details"]["user_details"] = $temp["user_details"];
      }
      $temp = $workcontroller->fetchWorkByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['works'] = $temp['works'];
      }
  
      $temp = $placeController->fetchPlacesOfUser($username);

      if ($temp['error'] == false) {
        $response['details']['city'] = $temp['city'];
      }

      $temp = $userscollegeController->fetchCollegeByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['college'] = $temp['college'];
      }

      $temp = $userssocialController->fetchSocialDetailsByUsername($username);

      if ($temp['error'] == false) {
        $response['details']['socialMedia'] = $temp['socialMedia'];
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

  
  public function deleteUserAccount($username, $password)
  {
    $userImp = new UserImp();
    $response = array();

    $resp = $userImp->deleteUserAccount($username, $password);
    return $resp;
  }
}
?>