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

	// New
	public function createBuzz($username, $title, $description, $location, $role)
	{
		$response = array();
		$feedid = uniqid($username);
		$title = "New Post";
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( feed_id,username ,  title ,  description ,  location ,role ) VALUES ('" . $feedid . "','" . $username . "','" . $title . "','" . $description . "','" . $location . "',  '" . $role . "' ) ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz Created";
			$response['buzzid'] = $feedid;
		} 
		else {
			$response["error"] = true;
			$response["message"] = "Buzz Not Created";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function createBuzzAnonymously($username, $title, $description, $location, $role)
	{
		$response = array();
		$feedid = uniqid($username);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( feed_id,username ,  title ,  description ,  location ,role , is_anonymous) VALUES ('" . $feedid . "','" . $username . "','" . $title . "','" . $description . "','" . $location . "',  '" . $role . "',1 ) ");
		if ($stmt) {
			$stmt2 = mysqli_query($this->conn, "select * from feed where feed_id='" . $feedid . "' order by timestamp DESC");
			while ($row = mysqli_fetch_assoc($stmt2)) {
				$response['buzzid'] = $row['feed_id'];
				$response['description'] = $row['description'];
				$response['time'] = $row['timestamp'];
				$response["error"] = false;
				$response["message"] = "Feed Uploaded";
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not Inserted";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}


	public function uploadImageToBuzz($feed_id, $img)
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


	public function voteBuzz($username, $feedid, $up, $down)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "SELECT * FROM feed_votes WHERE feed_id='" . $feedid . "' and username='" . $username . "'");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "UPDATE feed_votes SET upvotes='" . $up . "' , downvotes='" . $down . "' WHERE feed_id='" . $feedid . "' and username='" . $username . "'");
			if ($stmt) {
				$response["error"] = false;
				$response['message'] = "vote updated";
				$response['upvotes'] = array();
				$response['downvotes'] = array();
				$stmt = mysqli_query($this->conn, "SELECT username, timestamp FROM feed_votes WHERE feed_id='" . $feedid . "' and upvotes = 1");
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["upvotes"], $row);
				}
				$stmt = mysqli_query($this->conn, "SELECT username, timestamp FROM feed_votes WHERE feed_id='" . $feedid . "'and downvotes = 1");
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["downvotes"], $row);
				}
			} else {
				$response["error"] = true;
				$response["message"] = "error in updating vote";
				$response['upvotes'] = array();
				$response['downvotes'] = array();
				$response["info"] = mysqli_error($this->conn);
			}
		} else {
			$stmt = mysqli_query($this->conn, "INSERT INTO  feed_votes ( feed_id ,  username ,  upvotes ,  downvotes ) VALUES ('" . $feedid . "','" . $username . "','" . $up . "','" . $down . "')");
			if ($stmt) {
				$response["error"] = false;
				$response['message'] = "feed upvoted";
				$response['upvotes'] = array();
				$response['downvotes'] = array();
				$stmt = mysqli_query($this->conn, "SELECT username, timestamp FROM feed_votes WHERE feed_id='" . $feedid . "' and upvotes = 1");
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["upvotes"], $row);
				}
				$stmt = mysqli_query($this->conn, "SELECT username, timestamp FROM feed_votes WHERE feed_id='" . $feedid . "'and downvotes = 1");
				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["downvotes"], $row);
				}
			} else {
				$response["error"] = true;
				$response["message"] = "error in updating vote";
				$response['upvotes'] = array();
				$response['downvotes'] = array();
				$response["info"] = mysqli_error($this->conn);
			}
		}
		return $response;
	}

	public function shareBuzz($username, $feedid, $description){
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO feed_shared ( feed_id,username, description) VALUES ('" . $feedid . "','" . $username . "','".$description."' ) ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Feed Shared";
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not Shared";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function hideBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO buzz_hide ( buzz_id,username ) VALUES ('" . $buzzid . "','" . $username . "' ) ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz Hide";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz Not Hidden";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function unHideBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "Delete from buzz_hide  where buzz_id = '" . $buzzid . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz UnHidden";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz not unhidden";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		
		return $response;

	}

	public function saveBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO buzz_save ( buzz_id,username ) VALUES ('" . $buzzid . "','" . $username . "' ) ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz Saved";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz Not Saved";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function unSaveBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "Delete from buzz_save where buzz_id = '".$buzzid."'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz UnSaved";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz Not UnSaved";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function followBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "INSERT INTO buzz_follow ( followed_to,followed_by ) VALUES ('" . $buzzid . "','" . $username . "' ) ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz Followed";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz Not Followed";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function unfollowBuzz($username, $buzzid){
		$response = array();
		$stmt = mysqli_query($this->conn, "Delete from buzz_follow where followed_by = '".$username."' and followed_to = '".$buzzid."'  ");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Buzz Unfollowed";
		} else {
			$response["error"] = true;
			$response["message"] = "Buzz Not Unfollowed";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}









	// Old





	public function Fetchfeedbylocation($location)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from feed where location='" . $location . "' order by timestamp ASC");
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

		$stmt = mysqli_query($this->conn, "select * from feed where username='" . $username . "' order by timestamp ASC");
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
			$response["error"] = false;
			$response["upvote_list"] = array();
			$response["downvote_list"] = array();
			$stmt = mysqli_query($this->conn, "select username,timestamp from feed_votes where feed_id='" . $feedid . "' and upvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["upvote_message"] = "upvotes Found";

				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["upvote_list"], $row);
				}
			} else {
				$response["upvote_message"] = "upvote Not found";
				$response["upvote_error_mess"] = mysqli_error($this->conn);
			}
			$stmt = mysqli_query($this->conn, "select username,timestamp from feed_votes where feed_id='" . $feedid . "' and downvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["downvote_message"] = "downvote Found";

				while ($row = mysqli_fetch_assoc($stmt)) {
					array_push($response["downvote_list"], $row);
				}
			} else {
				$response["downvote_message"] = "no downvote found";
				$response["downvote_error_mess"] = mysqli_error($this->conn);
			}
		} else {
			$response["error"] = true;
			$response['message'] = "no votes found";
			$response["error_mess"] = mysqli_error($this->conn);
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
					array_push($response["image_link"], $row2["image_url"]);
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

	public function fetchAllFeed($username)
	{
		$response = array();
		$response["Feed"] = array();
		$stmt = mysqli_query($this->conn, "select * from feed order by timestamp DESC");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
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
	
	public function fetchAllFeedWithoutUser()
	{
		$response = array();
		$response["Feed"] = array();
		$stmt = mysqli_query($this->conn, "select * from feed order by timestamp DESC");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
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
	
	public function  Uploadfeed($username, $title, $description, $location, $role)

	{
		$response = array();
		$feedid = uniqid($username);
		$stmt = mysqli_query($this->conn, "INSERT INTO feed ( feed_id,username ,  title ,  description ,  location ,role ) VALUES ('" . $feedid . "','" . $username . "','" . $title . "','" . $description . "','" . $location . "',  '" . $role . "' ) ");
		if ($stmt) {
			$stmt2 = mysqli_query($this->conn, "select * from feed where feed_id='" . $feedid . "' order by timestamp ASC");
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
			$response["error"] = false;
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
	public function Fetchvotesonfeedbyuser($feedid, $username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select * from feed_votes where feed_id='" . $feedid . "' and username='" . $username . "'");
		if (mysqli_num_rows($stmt) > 0) {
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "' and username='" . $username . "' and upvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["buzz_upvotes"] = true;
			} else {
				$response["buzz_upvotes"] = false;
			}
			$stmt = mysqli_query($this->conn, "select username from feed_votes where feed_id='" . $feedid . "'and username='" . $username . "' and downvotes = 1 ");
			if (mysqli_num_rows($stmt) > 0) {
				$response["error"] = false;
				$response["buzz_downvote"] = true;
			} else {
				$response["buzz_downvote"] = false;
			}
		} else {
			$response["error"] = true;
			$response["bizz_vote"] = false;
			$response["downvote_error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function  editFeed($username, $feed_id, $title, $description, $location)
	{
		$response = array();
		$feedController = new FeedController();
		$stmt = mysqli_query($this->conn, "UPDATE feed set title ='" . $title . "',  description='" . $description . "' ,  location='" . $location . "' where feed_id='" . $feed_id . "'");
		if ($stmt) {
			$response["message"] = "feed edited";
			$response["error"] = false;
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not edited";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchFeedByRole($role)
	{
		$response = array();
		$response["feed"] = array();
		$stmt = mysqli_query($this->conn, "select * from feed where role='" . $role . "' order by timestamp ASC");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Feed Found";
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["feed"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Feed Not found";
			$response["error mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchSaveBuzz($username){
		$response = array();
		$response["save_buzz"]=array();
		$stmt = mysqli_query($this->conn, "select * from buzz_save where username='".$username."'");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Saved Buzz found";
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["save_buzz"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "Saved Buzz Not Found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchHideBuzz($username){
		$response = array();
		$stmt = mysqli_query($this->conn, "select * from buzz_hide where username='".$username."'");
		$response["hide_buzz"]=array();
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "hide Buzz found";
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["hide_buzz"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "hide Buzz Not Found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchShareBuzz($username){
		$response = array();
		$response["shared_buzz"]=array();
		$stmt = mysqli_query($this->conn, "select * from feed_shared where username='".$username."'");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "shared Buzz found";
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["shared_buzz"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "shared Buzz Not Found";
			$response["error_mess"] = mysqli_error($this->conn);
		}
		return $response;
	}
	public function fetchFeedById($feedid)
	{
		$response = array();

		$stmt = mysqli_query($this->conn, "select * from feed where feed_id='" . $feedid . "'");
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
