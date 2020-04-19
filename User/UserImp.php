<?php 

class UserImp{

    function __construct(){
        require_once dirname(__FILE__) . '/UserQuery.php';
    }

    public function loginUserWithUsername($username,  $password){
        $userQuery = new UserQuery();
		return $userQuery->loginUserWithUsername($username,  $password);
    }
    
    public function loginUserWithEmail($username,  $password){
        $userQuery = new UserQuery();
		return $userQuery->loginUserWithEmail($username,  $password);
    }
    
    public function fetchUserByUsername($username){
		$userQuery = new UserQuery();
		return $userQuery->fetchUserByUsername($username);
	}
    public function clearUser(){
        $userQuery = new UserQuery();
		return $userQuery->clearUser();
    }

}

?>