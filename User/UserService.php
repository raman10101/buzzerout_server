<?php 

class UserService{

    function __construct(){
        require_once dirname(__FILE__) . '/UserImp.php';
        require_once dirname(__FILE__) . '/UserController.php';
    }
	
    public function loginUserWithUsername($username,  $password){
        $userImp = new UserImp();
        $response=$userImp->loginUserWithUsername($username,  $password);
        return $response;
    }
    
    public function loginUserWithEmail($username,  $password){
        $userImp = new UserImp();
        $response=$userImp->loginUserWithEmail($username,  $password);
      return $response;
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