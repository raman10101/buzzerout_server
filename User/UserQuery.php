<?php

class UserQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function loginUser($username,  $password)
	{
		$response = array();

		$stmt = mysqli_query($this->conn,"select * from users where username='".$username."' and password ='".$password."' ");
		if(mysqli_num_rows($stmt) > 0){
			$response["error"] = false;
			$response["message"] = "User Found";
			$response["user"] = mysqli_fetch_assoc($stmt);
		}else{
			$response["error"] = true;
			$response["message"] = "User Not found";

		}
		return $response;
	}

}
