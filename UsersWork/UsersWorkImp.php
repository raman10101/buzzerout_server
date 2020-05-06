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
    
    public function editWork($username,  $work_place, $work_profile,$work_id){
		$usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->editWork($username,  $work_place, $work_profile,$work_id);
	}
    
    public function fetchWorkByUsername($username)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->fetchWorkByUsername($username);
    }
    
    public function fetchWorkOfAllUsers($username)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->fetchWorkOfAllUsers($username);
    }
    
    public function deleteWorkDetailsById($id)
    {
        $usersworkQuery = new UsersWorkQuery();
        return $usersworkQuery->deleteWorkDetailsById($id);
    }
    
}
