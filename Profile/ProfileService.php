<?php

class ProfileService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/ProfileImp.php';
    }
    public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
    {
        $ProfileImp = new ProfileImp();
        return $ProfileImp->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);
    }
    public function fetchProfileOfUser($username)
    {
        $ProfileImp = new ProfileImp();
        return $ProfileImp->fetchProfileOfUser($username);
    }
}
