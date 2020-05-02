<?php 

class AuthImp{

    function __construct(){
        require_once dirname(__FILE__) . '/AuthQuery.php';
    }

    public function authUser($username)
    {
        $authQuery = new AuthQuery();
		return $authQuery->authUser($username);
    }


}
