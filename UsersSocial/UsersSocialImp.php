<?php

class UsersSocialImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersSocialQuery.php';
    }


    public function addSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
    {
        $userssocialQuery = new UsersSocialQuery();
        return $userssocialQuery->addSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
    }
    
    public function updateSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
    {
        $userssocialQuery = new UsersSocialQuery();
        return $userssocialQuery->updateSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
    }

    public function fetchSocialDetailsByUsername($username)
    {
        $userssocialQuery = new UsersSocialQuery();
        return $userssocialQuery->fetchSocialDetailsByUsername($username);
    }
    
    public function deleteSocialDetailsById($id)
    {
        $userssocialQuery = new UsersSocialQuery();
        return $userssocialQuery->deleteSocialDetailsById($id);
    }
    
}
