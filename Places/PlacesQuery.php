<?php

class PlacesQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function addNewPlace($username, $place_name,$place_state)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "INSERT INTO  users_places ( username ,  place_name , place_state ) VALUES ('" . $username . "','" . $place_name . "','" . $place_state . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Places added";
		} else {
			$response["error"] = true;
			$response["message"] = "Places Not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchPlacesOfUser($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "SELECT * FROM  users_laces  WHERE username = '" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Places created";
			$response["Places_detail"] = array();
			while($row=mysqli_fetch_assoc($stmt)){
				array_push($response["Places_detail"],$row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Places Not created";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
