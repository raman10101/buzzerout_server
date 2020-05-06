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
  }

  public function loginUserWithUsername($username,  $password)
  {
    $userImp = new UserImp();

    $authController = new AuthController();
    $usercontroller = new UserController();
    $feedController = new FeedController();
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
  public function fetchUserByEmail($email)
  {
    $userImp = new UserImp();
    return $userImp->fetchUserByEmail($email);
  }

  public function fetchAllUsers()
  {
    $userImp = new UserImp();
    return $userImp->fetchAllUsers();
  }

  public function clearUser()
  {
    $userImp = new UserImp();
    return $userImp->clearUser();
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
      $response["details"]["details"] = array();

      $temp = $profilecontroller->fetchProfileOfUser($username);
      if ($temp['error'] == false) {
        $response["details"]["profile"] = $temp["profile_detail"];
      }
      $temp = $detailController->fetchUserDetail($username);
      if ($temp['error'] == false) {
        $response["details"]["details"] = $temp["userdetails"];
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

  public function forgotPassword($email)
  {
    $userImp = new UserImp();
    return $userImp->forgotPassword($email);
  }
}
