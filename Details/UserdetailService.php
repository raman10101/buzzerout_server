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
        return $UserdetailImp->createUserDetail($username, $about_you, $other_name, $fav_quote);
    }
    public function fetchUserDetail($username)
    {
        $UserdetailImp = new UserdetailImp();
        return $UserdetailImp->fetchUserDetail($username);
    }
    public function updateUserDetail($username, $about_you, $other_name, $fav_quote)
    {
        $UserdetailImp = new UserdetailImp();
        $UserdetailController=new UserdetailController();
        $response=$UserdetailImp->updateUserDetail($username, $about_you, $other_name, $fav_quote);
        if($response["error"]==false){
            $temp=$UserdetailController->fetchUserDetail($username);
            $response["updated_detail"]=$temp["User_detail"];
        }
        return $response;
    }

}
