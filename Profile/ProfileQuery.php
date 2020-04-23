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
			$response["message"] = "Profile Fetched";
			$response["profile_detail"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["profile_detail"],$row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function updateMobileAddress($username, $mobile, $address)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "update users_profile set user_mobile='" . $mobile . "' , user_address='" . $address . "' WHERE username = '" . $username . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Profile update";
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not update";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function updateDobGender($username, $dob, $gender)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "update users_profile set user_dob='" . $dob . "' , user_gender='" . $gender . "' WHERE username = '" . $username . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Profile update";
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not update";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
