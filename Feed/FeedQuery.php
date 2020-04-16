<?php

class FeedQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function Fetchfeedbylocation($location)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from Feed where location='" . $location . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["Feed"] = mysqli_fetch_assoc($stmt);
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
		}
		return $response;
	}

	public function Fetchfeedbyusername($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from Feed where location='" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["Feed"] = mysqli_fetch_assoc($stmt);
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
		}
		return $response;
	}
}
