<?php

class UsersWorkService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersWorkImp.php';
    }
    public function addWork($username,  $work_place, $work_profile)
    {
        $usersworkImp = new UsersWorkImp();
        return $usersworkImp->addWork($username,  $work_place, $work_profile);
    }
    
    public function fetchWorkByUsername($username)
    {
        $usersworkImp = new UsersWorkImp();
        return $usersworkImp->fetchWorkByUsername($username);
    }
    
    public function deleteWorkDetailsById($id)
    {
        $usersworkImp = new UsersWorkImp();
        return $usersworkImp->deleteWorkDetailsById($id);
    }

}
