<?php 

class AuthQuery{

    private $conn;

    function __construct(){
        require_once  './../Config/Connect.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }

    public function authUser($username)
	{
		$response = array();
        $response['error'] = false;
        $response['message'] = "User is authenticated";
		return $response;
	}

}

?>