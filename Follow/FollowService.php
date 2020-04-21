<?php

class FollowService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FollowImp.php';
    }
    public function fetchFollowing($username)
    {
        $followImp = new FollowImp();
        return $followImp->fetchFollowing($username);
    }
    public function newFollow($by, $to)
    {
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
        $followImp = new FollowImp();
        return $followImp->deleteFollowing($username, $to);
    }
    public function deleteFollower($username, $by)
    {
        $followImp = new FollowImp();
        return $followImp->deleteFollower($username, $by);
    }
    public function deleteUserConnections($username)
    {
        $followImp = new FollowImp();
        return $followImp->deleteUserConnections($username);
    }
}
