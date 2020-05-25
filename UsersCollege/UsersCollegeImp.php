<?php

class UsersCollegeImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersCollegeQuery.php';
    }


    public function addCollege($username,  $college_name, $college_place)
    {
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->addCollege($username,  $college_name, $college_place);
    }

    public function editCollege($username,  $college_name, $college_place,$college_id){
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->editCollege($username,  $college_name, $college_place,$college_id);
    }
    
    public function fetchCollegeByUsername($username)
    {
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->fetchCollegeByUsername($username);
    }
    
    public function fetchCollegeOfAllUsers($username)
    {
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->fetchCollegeOfAllUsers($username);
    }
    
    public function fetchCollegeById($username, $college_id)
    {
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->fetchCollegeById($username,$college_id);
    }
    public function deleteCollegeDetailsById($id)
    {
        $userscollegeQuery = new UsersCollegeQuery();
        return $userscollegeQuery->deleteCollegeDetailsById($id);
    }

    public function clearUsersCollege($username){
		$userscollegeQuery = new UsersCollegeQuery();
		return $userscollegeQuery->clearUsersCollege($username);
	}
    
}
