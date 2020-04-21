<?php

class FollowImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FollowQuery.php';
    }


    public function fetchFollowing($username)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->fetchFollowing($username);
    }
    public function newFollow($by,$to)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->newFollow($by,$to);
    }
    public function fetchFollowedBy($username)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->fetchFollowedBy($username);
    }
    public function deleteFollowing($username,$to)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->deleteFollowing($username,$to);
    }
    public function deleteFollower($username,$by)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->deleteFollower($username,$by);
    }
    public function deleteUserConnections($username)
    {
        $FollowQuery = new FollowQuery();
        return $FollowQuery->deleteUserConnections($username);
    }
    
}
