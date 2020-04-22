<?php

class UsersSocialQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function addSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
	{
		$response = array();

        $stmt = mysqli_query($this->conn, "insert into users_social (username, user_facebook, user_twitter, user_google_plus, user_instagram, user_youtube) values('".$username."','".$user_facebook."','".$user_twitter."','".$user_google_plus."','".$user_instagram."','".$user_youtube."')");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "social accounts added!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "social accounts not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function updateSocialDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
	{
		$response = array();

        $stmt = mysqli_query($this->conn, "UPDATE users_social SET user_facebook = '" . $user_facebook . "', user_twitter ='" . $user_twitter . "', user_google_plus = '" . $user_google_plus . ", user_instagram = '" . $user_instagram . "',user_youtube = '" . $user_youtube . "'  WHERE username = '" . $username . "'");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "social accounts updated!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "social accounts not updated";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchSocialDetailsByUsername($username)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users_social where username = '".$username."'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "social accounts found.";
            $response["social_accounts_details"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["social_accounts_details"],$row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No social accounts found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function deleteSocialDetailsById($id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM users_social where id = '".$id."'");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "social accounts  deleted.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "social accounts not deleted";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

}
