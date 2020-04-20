<?php 

class UserService{

    function __construct(){
        require_once dirname(__FILE__) . '/UserImp.php';
    }
	
    public function loginUserWithUsername($username,  $password){
        $userImp = new UserImp();
		return $userImp->loginUserWithUsername($username,  $password);
    }
    
    public function loginUserWithEmail($username,  $password){
        $userImp = new UserImp();
		return $userImp->loginUserWithEmail($username,  $password);
    }
    
    public function fetchUserByUsername($username){
		$userImp = new UserImp();
		return $userImp->fetchUserByUsername($username);
    }
    
    public function fetchAllUsers(){
		$userImp = new UserImp();
		return $userImp->fetchAllUsers();
    }
    
    public function clearUser(){
        $userImp = new UserImp();
		return $userImp->clearUser();
    }

}

?>