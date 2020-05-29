<?php

class NewUpdatesQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	function fetchAllUpdates()
	{
		$response = array();
		$response["updates"] = [];
		$stmt = mysqli_query($this->conn, 'select * from new_updates');
		if (mysqli_num_rows($stmt) > 0) {
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["updates"], $row);
			}
			$response["error"] = false;
			$response["message"] = "New Updates Found";
		}
		$response["error"] = true;
		$response["message"] = "New Updates Npt Found";
		return $response;
	}
}
