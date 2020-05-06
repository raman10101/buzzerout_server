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
	public function updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital){
		$response = array();
		$stmt = mysqli_query($this->conn, "update users_profile set first_name ='".$firstname."', last_name='".$lastname."', user_city='".$city."', user_state='".$state."', user_country='".$country."', user_gender='".$gender."',user_dob='".$dob."', user_marital='".$marital."'  where username = '".$username."' ");
		if($stmt){
			$response["error"] = false;
			$response["message"] = "User Updated";
		}else{
			$response["error"] = true;
			$response["message"] = "User Not Updated";
		}
		return $response;
	}
	public function createEmptyProfileOfUser($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "INSERT INTO  users_profile ( username ) VALUES ('" . $username . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Emppty Profile created";
		} else {
			$response["error"] = true;
			$response["message"] = "Empty Profile Not created";
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
			$response["profile_detail"] = mysqli_fetch_assoc($stmt);
			// while($row = mysqli_fetch_assoc($stmt)){
			// 	array_push($response["profile_detail"],$row);
			// }
		} else {
			$response["error"] = true;
			$response["message"] = "Profile Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchProfileOfAllUsers($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "SELECT * FROM  users_profile ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Profile Fetched";
			$response["profiles"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["profiles"],$row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Profiles Not found";
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
	public function updateDobGender($username, $dob,$uob, $gender)
	{
		$response = array();
		// Date
		// M/D
		// YEar
		// 1998
		$month = explode("/",$dob);
		$monthString = $uob.'-'.$month[0].'-'.$month[1];
		$timestamp = strtotime($monthString);
		$date = date("Y-m-d",$timestamp);
		$stmt = mysqli_query($this->conn, "update users_profile set user_dob='" . $date . "' , user_gender='" . $gender . "' WHERE username = '" . $username . "' ");
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
	public function updateUserProfileImage($username,$img)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "update users_profile set  user_profile_image='" . $img . "' WHERE username = '" . $username . "' ");
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
	public function updateUserTimelineImage($username,$img)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "update users_profile set  user_timeline_image='" . $img . "' WHERE username = '" . $username . "' ");
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

