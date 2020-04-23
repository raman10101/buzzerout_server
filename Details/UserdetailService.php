<?php

use Slim\Middleware\Flash;

class UserdetailService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UserdetailImp.php';
    }
    public function createUserDetail($username, $about_you, $other_name, $fav_quote)
    {
        $UserdetailImp = new UserdetailImp();
        $UserDetailController=new UserdetailController();
        $resp = $UserdetailImp->createUserDetail($username, $about_you, $other_name, $fav_quote);
        if($resp["error"] == false){
            $respController = $UserDetailController->fetchUserDetail($username);
            $resp["userdetails"] = $respController["userdetails"];
        }
        return $resp;
    }
    public function fetchUserDetail($username)
    {
        $UserdetailImp = new UserdetailImp();
        return $UserdetailImp->fetchUserDetail($username);
    }
    public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
    {
        $UserdetailImp = new UserdetailImp();
        $UserDetailController=new UserdetailController();
        $userDetailFetchResp = $UserDetailController->fetchUserDetail($username);
        if($userDetailFetchResp["error"] == false){
            $response=$UserdetailImp->updateUserDetails($username, $about_you, $other_name, $fav_quote);
            if($response["error"]==false){
                $respController = $UserDetailController->fetchUserDetail($username);
                $response["userdetails"] = $respController["userdetails"];
            }
        }else{
            return $UserDetailController->createUserDetail($username, $about_you, $other_name, $fav_quote);
        }
        
        return $response;
    }

}
