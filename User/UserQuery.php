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

	public function loginUserWithUsername($username,  $password)
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
	
	public function loginUserWithEmail($username,  $password)
	{
		$response = array();

		$stmt = mysqli_query($this->conn,"select * from users where email='".$username."' and password ='".$password."' ");
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

	public function fetchUserByUsername($username)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users where username = '". $username. "'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "User found.";
            $response['user'] = $stmt->fetch_assoc();
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No user found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function clearUser()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM users;");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "All cleared.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "clearing not succesfull";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
}
