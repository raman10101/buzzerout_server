<?php

class UserdetailQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function createUserDetail($username, $about_you, $other_name, $fav_quote)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "INSERT INTO  users_details ( username ,  about_you ,  other_name ,  favorite_quote ) VALUES ('" . $username . "','" . $about_you . "','" . $other_name . "','" . $fav_quote . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Userdetail created";
		} else {
			$response["error"] = true;
			$response["message"] = "Userdetail Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchUserDetail($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "SELECT * FROM  users_details  WHERE username = '" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Userdetail created";
			$response["userdetails"] = mysqli_fetch_assoc($stmt);
			unset($response["userdetails"]['id']);
            unset($response["userdetails"]['username']);
		} else {
			$response["error"] = true;
			$response["message"] = "Userdetail Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchUserDetailOfAllUsers($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "SELECT * FROM  users_details ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Userdetail Found";
			$response["userdetails"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["userdetails"],$row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Userdetail Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "update users_details set about_you='" . $about_you . "' , other_name='" . $other_name . "',favorite_quote='".$fav_quote."' WHERE username = '" . $username . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Userdetail update";
		} else {
			$response["error"] = true;
			$response["message"] = "Userdetail Not update";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

}
