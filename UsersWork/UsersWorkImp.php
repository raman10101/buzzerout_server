<?php

class UsersWorkImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersWorkQuery.php';
    }


    public function addWork($username,  $work_place, $work_profile)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->addWork($username,  $work_place, $work_profile);
    }
    
    public function fetchWorkByUsername($username)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->fetchWorkByUsername($username);
    }
    
    public function deleteWorkDetailsById($id)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->deleteWorkDetailsById($id);
    }
    
}
