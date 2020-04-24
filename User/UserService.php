<?php

class UserService
{

  function __construct()
  {
    require_once dirname(__FILE__) . '/UserImp.php';
    require_once dirname(__FILE__) . '/UserController.php';
    require_once '../Profile/ProfileController.php';
    require_once '../UsersWork/UsersWorkController.php';
    require_once '../UsersCollege/UsersCollegeController.php';
    require_once '../UsersSocial/UsersSocialController.php';
    require_once '../Details/UserdetailController.php';

  }

  public function loginUserWithUsername($username,  $password)
  {
    $userImp = new UserImp();
    $response= $userImp->loginUserWithUsername($username,  $password);
    $usercontroller=new UserController();
    if($response['error']==true){
      $response['user']=$usercontroller->fetchaAllDetailOfUser($username);
    }
  }

  public function loginUserWithEmail($username,  $password)
  {
    $userImp = new UserImp();
    $response=$userImp->loginUserWithEmail($username,  $password);
    $usercontroller=new UserController();
    if($response['error']==true){
      $response['user']=$usercontroller->fetchaAllDetailOfUser($username);
    }
  }

  public function fetchUserByUsername($username)
  {
    $userImp = new UserImp();
    return $userImp->fetchUserByUsername($username);
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
    if($resp["error"] == false){
      $respController = $userController->fetchUserByUsername($username);
      if($respController["error"] == false){
        $resp["user"] = $respController["user"];
      }else{
        $resp["error"] = true;
        $resp["message"] = "User Not Found";
      }
      
    }
    return $resp;
  }
  public function fetchaAllDetailOfUser($username){
    $response=array();
    $usercontroller=new UserController();
    $temp=$usercontroller->fetchAllUsers();
    if($temp['error']==false){
      $response["user"]=$temp['user'];
    }

    $profilecontroller=new ProfileController();
    $temp=$profilecontroller->fetchProfileOfUser($username);
    if($temp['error']==false){
      $response['user']['user_address']=$temp['user_address'];
      $response['user']['user_mobile']=$temp['user_mobile'];
      $response['user']['user_gender']=$temp['user_gender'];
      $response['user']['user_dob']=$temp['user_dob'];
      $response['user']['user_profile_image']=$temp['user_profile_image'];
      $response['user']['user_timeline_image']=$temp['user_timeline_image'];
      $response['user']['user_website']=$temp['user_website'];
      $response['user']['user_social_link']=$temp['user_social_link'];
    }
    $detailController = new UserdetailController();
    $temp = $detailController->fetchUserDetail($username);
    if($temp['error']==false){
      $response['user']['about_you']=$temp['about_you'];
      $response['user']['other_name']=$temp['other_name'];
      $response['user']['favorite_quote']=$temp['favorite_quote'];
    }
    $workcontroller=new UsersWorkController();
    $temp=$workcontroller->fetchWorkByUsername($username);
    $response['user']['works']=array();
    if($temp['error']==false){
      array_push($response['user']['works'],$temp['works']);
    }
    $placeController = new PlacesController();
    $temp = $placeController->fetchPlacesOfUser($username);
    $response['user']['city']=array();
    if($temp['error']==false){
      array_push($response['user']['city'],$temp['places']);
    }
    $userscollegeController = new UsersCollegeController();
    $temp = $userscollegeController->fetchCollegeByUsername($username);
    $response['user']['college']=array();
    if($temp['error']==false){
      array_push($response['user']['college'],$temp['colleges']);
    }
    $userssocialController = new UsersSocialController();
    $temp = $userssocialController->fetchSocialDetailsByUsername($username);
    $response['user']['socialMedia']=array();
    if($temp['error']==false){
      array_push($response['user']['socialMedia'],$temp['social_accounts_details']);
    }
    return $response;
}
}
