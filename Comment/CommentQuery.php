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

        $stmt = mysqli_query($this->conn, "insert into comments(feed_id,user_id,text,timestamp)
        values('" . $feed_id . "','" . $user_id . "','" . $text . ", NOW()");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "Comment added!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "Comment not added";
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
