<?php 

class UserImp{

    function __construct(){
        require_once dirname(__FILE__) . '/UserQuery.php';
    }




	        
    public function loginUser($username,  $password){
        $userQuery = new UserQuery();
		return $userQuery->loginUser($username,  $password);
	}


}

?>