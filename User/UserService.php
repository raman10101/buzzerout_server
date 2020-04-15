<?php 

class UserService{

    function __construct(){
        require_once dirname(__FILE__) . '/UserImp.php';
    }
	
    

	public function registerUser($first_name,$last_name,$username, $email, $password){
		$userImp = new UserImp();
		return $userImp->registerUser($first_name,$last_name,$username, $email, $password);
    }
    
        
    public function loginUser($username,  $password){
        $userImp = new UserImp();
		return $userImp->loginUser($username,  $password);
    }
    
    public function fetchProfileOfUser($username){
		$userimp = new UserImp();
		return $userimp->fetchProfileOfUser($username);
	}
}

?>