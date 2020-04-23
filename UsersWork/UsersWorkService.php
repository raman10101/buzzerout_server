<?php

class UsersWorkService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersWorkImp.php';
        require_once dirname(__FILE__) . '/UsersWorkController.php';
    }
    public function addWork($username,  $work_place, $work_profile)
    {
        $usersworkImp = new UsersWorkImp();
        $usersWorkController = new UsersWorkController();
        $resp =  $usersworkImp->addWork($username,  $work_place, $work_profile);
        if($resp["error"] == false){
            $respController = $usersWorkController->fetchWorkByUsername($username);
            $resp["works"] = $respController["works"];
        }
        return $resp;
    }
    public function editWork($username,  $work_place, $work_profile,$work_id){
        $usersworkImp = new UsersWorkImp();
        $usersWorkController = new UsersWorkController();
        $resp = $usersworkImp->editWork($username,  $work_place, $work_profile,$work_id);
        if($resp["error"] == false){
            $respController = $usersWorkController->fetchWorkByUsername($username);
            $resp["works"] = $respController["works"];
        }
        return $resp;
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
