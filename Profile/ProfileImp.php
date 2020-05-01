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
    public function createEmptyProfileOfUser($username)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->createEmptyProfileOfUser($username);
    }
    public function fetchProfileOfUser($username)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->fetchProfileOfUser($username);
    }
    public function updateMobileAddress($username, $mobile, $address)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->updateMobileAddress($username, $mobile, $address);
    }
    public function updateDobGender($username, $dob,$uob, $gender)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->updateDobGender($username, $dob, $uob,$gender);
    }
    public function updateUserTimelineImage($username,$img)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->updateUserTimelineImage($username,$img);
    }
    public function updateUserProfileImage($username,$img)
    {
        $ProfileQuery = new ProfileQuery();
        return $ProfileQuery->updateUserProfileImage($username,$img);
    }
}