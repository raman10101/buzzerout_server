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

	public function addComment($feed_id,  $user_id, $text)
	{
		$response = array();

        $stmt = mysqli_query($this->conn, "insert into comments (feed_id,user_id,text,timestamp) values('".$feed_id."','".$user_id."','".$text."',NOW())");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "Comment added!!";
			$response['comments'] = array();
			$stmt2 = mysqli_query($this->conn, "select *  FROM comments ");
			if(mysqli_num_rows($stmt2) > 0){  
				while($row = mysqli_fetch_assoc($stmt2)){
					array_push($response["comments"],$row);
				}
			}
        }
        else{
			$response["error"] = true;
			$response["message"] = "Comment not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function editComment($feed_id,  $user_id, $text)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "UPDATE comments SET text = '". $text."', modified = NOW() WHERE  feed_id = '".$feed_id."' AND user_id = '".$user_id."'");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "Comment edited";
        }
        else{
			$response["error"] = true;
			$response["message"] = "Comment not edited";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchCommentByFeed($feed_id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM comments where feed_id = '".$feed_id."'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "Comments found.";
			$response["comments"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				$stmt2 = mysqli_query($this->conn, "select *  FROM users where id = '".$row['user_id']."'");
				while($resp = mysqli_fetch_assoc($stmt2)){
					$row['commentUser_first_name'] = $resp['first_name'];
					$row['commentUser_last_name'] = $resp['last_name'];
					$row['commentUser'] = $resp['username'];
				// }
				$stmt3 = mysqli_query($this->conn, "select *  FROM users_profile where username = '".$resp['username']."'");
				while($resp = mysqli_fetch_assoc($stmt3)){
					$row['commentImg'] = $resp['user_profile_image'];
				}}
				array_push($response["comments"],$row);
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
	
	
	public function fetchAllComments()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM comments ");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "Comments found.";
            $response["comments"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["comments"],$row);
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
	
	public function deleteComment($id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM comments where id = '".$id."'");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "comment deleted.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "not deleted";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function deleteCommentByFeedId($feed_id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM comments where fedd_id = '".$feed_id."'");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "Comments deleted.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "Not deleted.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function clearComment()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM comments;");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "All cleared.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "clearing not succesfull";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
}
