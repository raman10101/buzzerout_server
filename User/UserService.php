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

}

?>