<?php

class UsersCollegeService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/UsersCollegeImp.php';
        require_once dirname(__FILE__) . '/UsersCollegeController.php';
    }
    public function addCollege($username,  $college_name, $college_place)
    {
        $userscollegeImp = new UsersCollegeImp();
        $usersCollegeController = new UsersCollegeController();
        $resp = $userscollegeImp->addCollege($username,  $college_name, $college_place);
        if($resp["error"] == false ){
            $respController = $usersCollegeController->fetchCollegeByUsername($username);
            $resp["colleges"] = $respController["colleges"];
        }
        return $resp;
    }
    
    public function editCollege($username,  $college_name, $college_place,$college_id){
        $userscollegeImp = new UsersCollegeImp();
        $usersCollegeController = new UsersCollegeController();
        $resp=  $userscollegeImp->editCollege($username,  $college_name, $college_place,$college_id);
        if($resp["error"] == false ){
            $respController = $usersCollegeController->fetchCollegeByUsername($username);
            $resp["colleges"] = $respController["colleges"];
        }
        return $resp;
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
