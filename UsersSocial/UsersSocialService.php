<?php

class UsersSocialService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersSocialImp.php';
        require_once  './../Config/Connect.php';
        $db = new Connect();
		$this->conn = $db->connect();
    }
    public function addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
    {
        $userssocialImp = new UsersSocialImp();
        $response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users_social where username = '".$username."'");
		if(mysqli_num_rows($stmt) > 0){  
            return $userssocialImp->updateSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
        }
        else
        {
            return $userssocialImp->addSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
        }
    }
    
    public function fetchSocialDetailsByUsername($username)
    {
        $userssocialImp = new UsersSocialImp();
        return $userssocialImp->fetchSocialDetailsByUsername($username);
    }
    
    public function deleteSocialDetailsById($id)
    {
        $userssocialImp = new UsersSocialImp();
        return $userssocialImp->deleteSocialDetailsById($id);
    }
}
