<?php

class FollowService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FollowImp.php';
        require_once  './../User/UserController.php';
    }
    public function fetchFollowing($username)
    {
        $followImp = new FollowImp();
        return $followImp->fetchFollowing($username);
    }
    public function newFollow($by, $to)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($by);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $followImp = new FollowImp();
        return $followImp->newFollow($by, $to);
    }
    public function fetchFollowedBy($username)
    {
        $followImp = new FollowImp();
        return $followImp->fetchFollowedBy($username);
    }
    public function deleteFollowing($username, $to)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $followImp = new FollowImp();
        return $followImp->deleteFollowing($username, $to);
    }
    public function deleteFollower($username, $by)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $followImp = new FollowImp();
        return $followImp->deleteFollower($username, $by);
    }
    public function deleteUserConnections($username)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $followImp = new FollowImp();
        return $followImp->deleteUserConnections($username);
    }
    public function deleteAllFollow()
    {
        $followImp = new FollowImp();
        return $followImp->deleteAllFollow();
    }
    public function fetchAllFollow()
	{
		$followImp = new FollowImp();
		return $followImp->fetchAllFollow();
	}
}
