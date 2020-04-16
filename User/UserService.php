<?php 

class UserService{

    function __construct(){
        require_once dirname(__FILE__) . '/UserImp.php';
    }
	
    


    
        
    public function loginUser($username,  $password){
        $userImp = new UserImp();
		return $userImp->loginUser($username,  $password);
    }
    

}

?>