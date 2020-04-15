<?php 

class UserImp{

    function __construct(){
        require_once dirname(__FILE__) . '/UserQuery.php';
    }


	public function registerUser($first_name,$last_name,$username, $email, $password){
		$userQuery = new UserQuery();
		return $userQuery->registerUser($first_name,$last_name,$username, $email, $password);
	}

	        
    public function loginUser($username,  $password){
        $userQuery = new UserQuery();
		return $userQuery->loginUser($username,  $password);
	}
	public function fetchProfileOfUser($username){
		$userService = new UserService();
		return $userImp-fetchProfileOfUser($username);
	}

}

?>