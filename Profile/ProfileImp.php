<?php

class ProfileImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/ProfileQuery.php';
    }


    public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);
    }
    public function fetchProfileOfUser($username)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->fetchProfileOfUser($username);
    }
}
