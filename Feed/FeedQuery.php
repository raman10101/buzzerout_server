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

		$stmt = mysqli_query($this->conn, "select * from Feed where usename='" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["Feed"] = mysqli_fetch_assoc($stmt);
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Fetchvotesonpost($feedid)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from Feed_votes where feed_id='" . $feedid . "' and upvotes = 1 ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "upvotes Found";
			$response["upvote list"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["upvote list"], $row);
			}
		} 
		else {
			$response["error"] = true;
			$response["message"] = "upvote Not found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		$stmt = mysqli_query($this->conn, "select * from Feed_votes where feed_id='" . $feedid . "' and downvotes = 1 ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "upvotes Found";
			$response["downvote list"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["downvote list"], $row);
			}
		} 
		else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function Uploadfeedimage($username, $title, $description, $location,  $img)
	{
		$response = array();
		$image_id = uniqid($img);
		$feedid = uniqid($image_id);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( usename ,  title ,  description ,  location ,  timestamp ) VALUES ('" . $username . "','" . $title . "','" . $description . "','" . $location . "',NOW()) ");
		if ($stmt) {
			$stmt = mysqli_query($this->conn, "INSERT INTO feed_images (  image_url ) VALUES ('" . $img . "') ");
			if ($stmt) {
				$stmt = mysqli_query($this->conn, "INSERT INTO  feed_images_mapper ( feed_id ,  image_id ) VALUES ('" . $feedid . "','" . $image_id . "') ");
				$response["error"] = false;
				$response["message image"] = "image uploaded";
			} else {
				$response["error"] = true;
				$response["message"] = mysqli_error($this->conn);
			}

			$response["message feed"] = "Feed uploaded";
		} else {
			$response["error"] = true;
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Uploadfeedvideo($username, $title, $description, $location, $video)
	{
		$response = array();
		$video_id = uniqid($video);
		$feedid = uniqid($video_id);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( usename ,  title ,  description ,  location ,  timestamp ) VALUES ('" . $username . "','" . $title . "','" . $description . "','" . $location . "',NOW()) ");
		if ($stmt) {
			$stmt = mysqli_query($this->conn, "INSERT INTO feed_videos (  video_url ) VALUES ('" . $video . "') ");
			if ($stmt) {
				$response["error"] = false;
				$response["message video"] = "video uploaded";
			} else {
				$response["error"] = true;
				$response["message"] = mysqli_error($this->conn);
			}

			$response["message feed"] = "Feed uploaded";
		} else {
			$response["error"] = true;
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Feedupvote($username, $feedid, $up, $down)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO  feed_votes ( feed_id ,  username ,  upvotes ,  downvotes ) VALUES ('" . $feedid . "','" . $username . "','" . $up . "','" . $down . "')");
		if ($stmt) {

			$response["error"] = false;
			if ($up == 1 && $down == 0) {
				$response["message feed"] = "Feed upvoted";
			}
			if ($up == 0 && $down == 1) {
				$response["message feed"] = "Feed downvoted";
			}
		} else {
			$response["error"] = true;
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Fetchallimageoffeed($feedid)
	{
		{
			$response = array();
	
			$stmt = mysqli_query($this->conn, "select * from feed_image_mapper where feed_id='" . $feedid . "' ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["image link"]=array();
				while ($row = mysqli_fetch_assoc($stmt)) {
					$stmt2=mysqli_query($this->conn, "select image_url from feed_image where id='" . $row["image_id"] . "' ");
					while($row2=(mysqli_fetch_assoc($stmt2))){
						array_push($response["image link"],$row2);
					}
				}
			} else {
				$response["error"] = true;
				$response["message"] = "Feed Not found";
				$response["error mess"] = mysqli_error($this->conn);
			}
			return $response;
		}
	}
}
