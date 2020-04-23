<?php

class UsersCollegeService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersCollegeImp.php';
    }
    public function addCollege($username,  $college_name, $college_place)
    {
        $userscollegeImp = new UsersCollegeImp();
        return $userscollegeImp->addCollege($username,  $college_name, $college_place);
    }
    
    public function fetchCollegeByUsername($username)
    {
        $userscollegeImp = new UsersCollegeImp();
        return $userscollegeImp->fetchCollegeByUsername($username);
    }
    
    public function deleteCollegeDetailsById($id)
    {
        $userscollegeImp = new UsersCollegeImp();
        return $userscollegeImp->deleteCollegeDetailsById($id);
    }

}
