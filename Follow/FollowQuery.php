<?php

class FollowQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}


	public function newFollow($by, $to)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "insert into users_follow (followed_by , followed_to) values ('" . $by . "', '" . $to . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Followed successfully";
		} else {
			$response["error"] = true;
			$response["message"] = "not able to follow";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}


	public function fetchFollowing($username)
	{
		$response = array();
		$response["following"] = array();
		$stmt = mysqli_query($this->conn, "select followed_to from users_follow where followed_by='" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Follow Found";
			$response["count"] = mysqli_num_rows($stmt);
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["following"], $row['followed_to']);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchFollowedBy($username)
	{
		$response = array();
		$response["followers"] = array();

		$stmt = mysqli_query($this->conn, "select followed_by from users_follow where followed_to='" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Follow Found";
			$response["count"] = mysqli_num_rows($stmt);
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["followers"], $row['followed_by']);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function deleteFollowing($username, $to)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "delete from users_follow where followed_by='" . $username . "' and followed_to='" . $to . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "following deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function deleteFollower($username, $by)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "delete from users_follow where followed_to ='" . $username . "' and followed_by='" . $by . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "followed to deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function deleteUserConnections($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "delete from users_follow where followed_to ='" . $username . "'");
		if ($stmt) {
			$stmt = mysqli_query($this->conn, "delete from users_follow where followed_by ='" . $username . "'");
			if ($stmt) {
				$response["error"] = false;
				$response["message"] = "followed to deleted";
			} else {
				$response["error"] = true;
				$response["message"] = "Follow Not found";
				$response["info"] = mysqli_error($this->conn);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function deleteAllFollow()
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "TRUNCATE TABLE users_follow");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "all follow deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Follow Not found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchAllFollow()
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from users_follow ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Entries Found";
			$response["followers"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["followers"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "No entries found";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
