<?php

class CommentQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function addComment($feed_id,  $username, $text)
	{
		$response = array();
		$comment_id = uniqid($feed_id.$username);
		$stmt = mysqli_query($this->conn, "insert into comments (comment_id, feed_id,user_id,text,timestamp) values('" . $comment_id . "','" . $feed_id . "','" . $username . "','" . $text . "',NOW())");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Comment added!!";
		} else {
			$response["error"] = true;
			$response["message"] = "Comment not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function editComment($comment_id, $username, $text)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "UPDATE comments SET text = '" . $text . "', modified = NOW() WHERE  comment_id = '" . $comment_id . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Comment edited";
		} else {
			$response["error"] = true;
			$response["message"] = "Comment not edited";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function fetchCommentByFeed($username, $feed_id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM comments where feed_id = '".$feed_id."' order by timestamp DESC");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "Comments found.";
			$response["comments"] = array();
			$result = array();

			while($row = mysqli_fetch_assoc($stmt)){
				$result["timestamp"] = $row["timestamp"];
				$result["text"] = $row["text"];
				$result['comment_id'] = $row['comment_id'];
				$stmt2 = mysqli_query($this->conn, "select *  FROM users_profile where username = '".$row['user_id']."'");
				while($resp = mysqli_fetch_assoc($stmt2)){
					$result['first_name'] = $resp['first_name'];
					$result['last_name'] = $resp['last_name'];
					$result['username'] = $resp['username'];
					$result['commentImg'] = $resp['user_profile_image'];
				}
				array_push($response["comments"],$result);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No comment found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function fetchCommentByCommentId($comment_id, $username){
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM comments where comment_id = '".$comment_id."'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "Comments found.";
			$response["comments"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response['comments'], $row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No comment found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	  }

	public function fetchAllComments($username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select *  FROM comments ");
		if (mysqli_num_rows($stmt) > 0) {
			$response["error"] = false;
			$response["message"] = "Comments found.";
			$response["comments"] = array();
			while ($row = mysqli_fetch_assoc($stmt)) {
				array_push($response["comments"], $row);
			}
		} else {
			$response["error"] = true;
			$response["message"] = "No comment found.";
			$response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function deleteCommentById($id, $username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "DELETE FROM comments where comment_id = '" . $id . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "comment deleted.";
		} else {
			$response["error"] = true;
			$response["message"] = "not deleted";
			$response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function deleteCommentByFeedId($username, $feed_id)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "DELETE FROM comments where feed_id = '" . $feed_id . "'");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "Comments deleted.";
		} else {
			$response["error"] = true;
			$response["message"] = "Not deleted.";
			$response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function clearComment($username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "DELETE FROM comments;");
		if ($stmt) {
			$response["error"] = false;
			$response["message"] = "All cleared.";
		} else {
			$response["error"] = true;
			$response["message"] = "clearing not succesfull";
			$response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
}
