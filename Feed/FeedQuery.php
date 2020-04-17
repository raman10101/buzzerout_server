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
	public function Uploadfeedimage( $username, $title, $description, $location,  $img)
	{
		$response = array();
		$image_id = uniqid($img);
		$feedid=uniqid($image_id);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( usename ,  title ,  description ,  location ,  timestamp ) VALUES ('" . $username . "','" . $title . "','" . $description . "','" . $location . "',NOW()) ");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "INSERT INTO feed_images (  image_url ) VALUES ('" . $img . "') "); {
				if (mysqli_num_rows($stmt) > 0) {
					$stmt = mysqli_query($this->conn, "INSERT INTO  feed_images_mapper ( feed_id ,  image_id ) VALUES ('" . $feedid . "','" . $image_id . "') ");
					$response["message image"] = "image uploaded";
				} else {
					$response["error"] = true;
					$response["message"] = mysqli_error($this->conn);
				}
			}
			$response["error"] = false;
			$response["message feed"] = "Feed uploaded";
			$response["Feed"] = mysqli_fetch_assoc($stmt);
		} else {
			$response["error"] = true;
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
