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

    // Authentication

    // |-> Auth Service -> User Valid Or NOt -> Role, Other Username variables

    // Authorisation

    // |-> $role == 0 (Live User), $rolw == 1 (Test USer)
    // If role == 0, throw error
    // |-> Role = 0, data for live people, else test also

    // Login Successfull

    // Profile Of USer
    // Feed Of User
    // Notifications Of User

    // Only That post will be returned
    // Add comment, only added comment, or only true false
    // Front -end

    // Front end - refresh, api check login, ya ni hai, login, local uska data hoga, but we will need to call fetch post ($username)

    // Authentcation Authorisation

    // Role According uski feeds usko meelengi

    // Two Fetch Feed, According Role -> Jeena
    // Fetch Feed According to Username

    $authController = new AuthController();
    $usercontroller = new UserController();
    $profileController = new ProfileController();
    $feedController = new FeedController();
    $response = $authController->authUser($username);
    if ($response['error'] == false){
      $response = $userImp->loginUserWithUsername($username,  $password);
      if ($response['error'] == false) {
        $resp = $usercontroller->fetchaAllDetailOfUser($username);
        $response["user"] = $resp["user"];
        $role = $response["user"]["profile"]['role'];
        $feedResp = $feedController->fetchFeedByROle($role);
        if ($feedResp['error'] == false){
          $response['feed'] = $feedResp['feed'];
        }
        else{
          $response['error'] = true;
          $response['message'] = "error in feed fetching by role";
        }
      }
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
  public function fetchUserByEmail($email){
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
    $response = array();
    $usercontroller = new UserController();
    $temp = $usercontroller->fetchUserByUsername($username);
    $response["user"] = array();
    $response['user']['college'] = array();
    $response['user']['socialMedia'] = array();
    $response['user']['works'] = array();
    $response['user']['city'] = array();
    if ($temp['error'] == false) {
      $response["user"]["first_name"] = $temp["user"]["first_name"];
      $response["user"]["last_name"] = $temp["user"]["last_name"];
      $response["user"]["email"] = $temp["user"]["email"];
      $response["user"]["username"] = $temp["user"]["username"];
    }

    $profilecontroller = new ProfileController();
    $temp = $profilecontroller->fetchProfileOfUser($username);
    if ($temp['error'] == false) {
      $response["user"]["profile"] = $temp["profile_detail"];
    }
    $detailController = new UserdetailController();
    $temp = $detailController->fetchUserDetail($username);
    if ($temp['error'] == false) {
      $response["user"]["details"] = $temp["userdetails"];
    }
    $workcontroller = new UsersWorkController();
    $temp = $workcontroller->fetchWorkByUsername($username);

    if ($temp['error'] == false) {
      $response['user']['works'] = $temp['works'];
    }
    $placeController = new PlacesController();
    $temp = $placeController->fetchPlacesOfUser($username);

    if ($temp['error'] == false) {
      $response['user']['city'] = $temp['places'];
    }
    $userscollegeController = new UsersCollegeController();
    $temp = $userscollegeController->fetchCollegeByUsername($username);

    if ($temp['error'] == false) {
      $response['user']['college'] = $temp['colleges'];
    }
    $userssocialController = new UsersSocialController();
    $temp = $userssocialController->fetchSocialDetailsByUsername($username);

    if ($temp['error'] == false) {
      $response['user']['socialMedia'] = $temp['social_accounts_details'];
    }
    return $response;
  }

  public function forgotPassword($email){
		$userImp = new UserImp();
		return $userImp->forgotPassword($email);
	}
}
?>