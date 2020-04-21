<?php

class ProfileQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "INSERT INTO  users_profile ( username ,  user_address ,  user_mobile ,  user_gender ,  user_dob ,  user_profile_image ,  user_timeline_image ) VALUES ('" . $username . "','" . $user_address . "','" . $user_mobile . "','" . $user_gender . "','" . $user_dob . "','" . $user_profile_image . "','" . $user_timeline_image . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Profile created";
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchProfileOfUser($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "SELECT * FROM  users_profile  WHERE username = '" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Profile created";
			$response["profile_detail"] = mysqli_fetch_assoc($stmt);
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
