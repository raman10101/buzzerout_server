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

		$stmt = mysqli_query($this->conn, "select * from feed where location='" . $location . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["Feed"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["Feed"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
		}
		return $response;
	}

	public function Fetchfeedbyusername($username)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from feed where username='" . $username . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["Feed"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["Feed"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Fetchvotesonfeed($feedid)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select * from feed_votes where feed_id='" . $feedid . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "' and upvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["upvote_message"] = "upvotes Found";
				$response["upvote_list"] = array();
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["upvote_list"], $row);
				}
			} else {
				$response["error"] = true;
				$response["upvote_message"] = "upvote Not found";
				$response["upvote_error_mess"] = mysqli_error($this->conn);
			}
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "' and downvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["downvote_message"] = "downvote Found";
				$response["downvote_list"] = array();
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["downvote_list"], $row);
				}
			} else {
				$response["error"] = true;
				$response["downvote_message"] = "no downvote found";
				$response["downvote_error_mess"] = mysqli_error($this->conn);
			}
		} else {
			$response["error"] = true;
			$response["downvote_message"] = "no votes found";
			$response["downvote_error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function Uploadfeedimage($feed_id, $img)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO  feed_images ( image_url ) VALUES ('" . $img . "')");
		if ($stmt) {
			$stmt = mysqli_query($this->conn, "SELECT *  FROM  feed_images  WHERE image_url='" . $img . "'");
			if (mysqli_num_rows($stmt) > 0) {
				$row = mysqli_fetch_assoc($stmt);
				$stmt = mysqli_query($this->conn, "INSERT INTO  feed_images_mapper ( feed_id ,  image_id ) VALUES ('" . $feed_id . "','" . $row["id"] . "') ");
				if ($stmt) {
					$response["error"] = false;
					$response["message"] = "image uploaded";
				} else {
					$response["error"] = true;
					$response["tag"] = "mapper no updated";
					$response["message"] = mysqli_error($this->conn);
				}
			} else {
				$response["error"] = true;
				$response["tag"] = "cannot fetch the img_url";
				$response["message"] = mysqli_error($this->conn);
			}
		} else {
			$response["error"] = true;
			$response["tag"] = "image_url no updated";
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Uploadfeedvideo($feedid, $video)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO  feed_videos ( feed_id ,  video_url ) VALUES ('" . $feedid . "','" . $video . "') ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "video uploaded";
		} else {
			$response["error"] = true;
			$response["message"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Feedupvote($username, $feedid, $up, $down)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "SELECT * FROM feed_votes WHERE feed_id='" . $feedid . "' and username='" . $username . "'");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "UPDATE feed_votes SET upvotes='" . $up . "' , downvotes='" . $down . "' WHERE feed_id='" . $feedid . "' and username='" . $username . "'");
			if ($stmt) {
				$response["error"] = false;
				$response["message"] = "vote updated";
			} else {
				$response["error"] = true;
				$response["message"] = "error in updating vote";
				$response["info"] = mysqli_error($this->conn);
			}
		} else {
			$stmt = mysqli_query($this->conn, "INSERT INTO  feed_votes ( feed_id ,  username ,  upvotes ,  downvotes ) VALUES ('" . $feedid . "','" . $username . "','" . $up . "','" . $down . "')");
			if ($stmt) {

				$response["error"] = false;
				if ($up == 1 && $down == 0) {
					$response["message_feed"] = "Feed upvoted";
				}
				if ($up == 0 && $down == 1) {
					$response["message_feed"] = "Feed downvoted";
				}
			} else {
				$response["error"] = true;
				$response["message"] = mysqli_error($this->conn);
			}
		}
		return $response;
	}
	public function Fetchallimageoffeed($feedid)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from feed_images_mapper where feed_id='" . $feedid . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["image_link"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				$stmt2 = mysqli_query($this->conn, "select image_url from feed_images where id='" . $row["image_id"] . "' ");
				while ($row2 = (mysqli_fetch_assoc($stmt2))) {
					array_push($response["image_link"], $row2);
				}
				$response["message"] = "feed images found";
			}
		} else {
			$response["error"] = true;
			$response["message"] = "no feed image found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchAllFeed()
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from feed ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["Feed"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["Feed"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function clearAllFeed()
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "truncate table feed_votes");
		if ($stmt) {
			$stmt = mysqli_query($this->conn, "truncate table feed_images");
			if ($stmt) {
				$stmt = mysqli_query($this->conn, "truncate table feed_images_mapper");
				if ($stmt) {
					$stmt = mysqli_query($this->conn, "truncate table feed_videos");
					if ($stmt) {
						$stmt = mysqli_query($this->conn, "truncate table feed");
						if ($stmt) {
							$response["error"] = false;
							$response["message"] = "success fully truncate";
						} else {
							$response["error"] = true;
							$response["message"] = "Feed Not deleted";
							$response["error_mess"] = mysqli_error($this->conn);
						}
					} else {
						$response["error"] = true;
						$response["message"] = "Feed video Not found";
						$response["error_mess"] = mysqli_error($this->conn);
					}
				} else {
					$response["error"] = true;
					$response["message"] = "Feed image mapper Not found";
					$response["error_mess"] = mysqli_error($this->conn);
				}
			} else {
				$response["error"] = true;
				$response["message"] = "Feed images  Not found";
				$response["error_mess"] = mysqli_error($this->conn);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed votes Not found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function  Uploadfeed($username, $title, $description, $location)

	{
		$response = array();
		$feedid = uniqid($username);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( feed_id,username ,  title ,  description ,  location ,  timestamp ) VALUES ('" . $feedid . "','" . $username . "','" . $title . "','" . $description . "','" . $location . "',NOW()) ");
		if ($stmt){
			$stmt2 = mysqli_query($this->conn, "select * from feed where feed_id='" . $feedid . "' ");
			while ($row = mysqli_fetch_assoc($stmt2)) {
				$response['feedid'] = $row['feed_id'];
				$response['description'] = $row['description'];
				$response['time'] = $row['timestamp'];
				$response["error"] = false;
				$response["message"] = "feed uploded";
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not inserted";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Fetchallvideooffeed($feedid)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select video_url from feed_videos where feed_id='" . $feedid . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			$response["video_link"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["video_link"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed video Not found";
		}
		return $response;
	}


	//delete (index not written)
	// feed delete 
	public function feedDelete($feedid)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "delete from feed where feed_id = '" . $feedid . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "all feed deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	// image delete
	public function imgdelete($feedid)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select * from feed_images_mapper where feed_id = '" . $feedid . "' ");
		if (mysqli_num_rows($stmt) > 0) {
			while ($row = mysqli_fetch_assoc($stmt)) {
				$image_id = $row["image_id"];
				$stmt2 = mysqli_query($this->conn, "delete from feed_images where id='" . $image_id . "' ");
				if ($stmt2) {
					$stmt2 = mysqli_query($this->conn, "delete from feed_images_mapper where  image_id='" . $image_id . "' ");
					if ($stmt2) {
						$response["error"] = false;
						$response["message"] = "all images deleted";
					} else {
						$response["error"] = true;
						$response["message"] = "feed_images_mapper delete error";
						$response["error_mess"] = mysqli_error($this->conn);
					}
				} else {
					$response["error"] = true;
					$response["message"] = "feed_images delete error";
					$response["error_mess"] = mysqli_error($this->conn);
				}
			}
		} else {
			$response["error"] = true;
			$response["message"] = "no image for feed";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	// video delete 
	public function videoDelete($feedid)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "delete from feed_videos where feed_id = '" . $feedid . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "all feed video deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	// vote delete
	public function voteDelete($feedid)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "delete from feed_votes where feed_id = '" . $feedid . "' ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "all feed votes deleted";
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function Fetchvotesonfeedbyuser($feedid,$username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select * from feed_votes where feed_id='" . $feedid . "' and username='".$username."'");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "' and username='".$username."' and upvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["buzz_upvotes"] = true;
			} 
			else{
				$response["buzz_upvotes"] = false;
			}
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "'and username='".$username."' and downvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["buzz_downvote"] = true;
			} else{
				$response["buzz_downvote"] = false;
			}
		} else {
			$response["error"] = true;
			$response["bizz_vote"] = false;
			$response["downvote_error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
}
