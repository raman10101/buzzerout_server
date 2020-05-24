<?php

class UserdetailImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UserdetailQuery.php';
    }


    public function createUserDetail($username, $about_you, $other_name, $fav_quote)
    {
        $UserdetailQuery = new UserdetailQuery();
        return $UserdetailQuery->createUserDetail($username, $about_you, $other_name, $fav_quote);
    }
    public function fetchUserDetail($username)
    {
        $UserdetailQuery = new UserdetailQuery();
        return $UserdetailQuery->fetchUserDetail($username);
    }
    
    public function fetchUserDetailOfAllUsers($username)
    {
        $UserdetailQuery = new UserdetailQuery();
        return $UserdetailQuery->fetchUserDetailOfAllUsers($username);
    }
    public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
    {
        $UserdetailQuery = new UserdetailQuery();
        return $UserdetailQuery->updateUserDetails($username, $about_you, $other_name, $fav_quote);
    }
    public function clearDetailTable($username)
    {
        $UserdetailQuery = new UserdetailQuery();
        return $UserdetailQuery->clearDetailTable($username);
    }
}
