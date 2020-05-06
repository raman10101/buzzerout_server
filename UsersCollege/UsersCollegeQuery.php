<?php

class UsersCollegeQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function addCollege($username,  $college_name, $college_place)
	{
		$response = array();

        $stmt = mysqli_query($this->conn, "insert into users_college (username,college_name,college_place) values('".$username."','".$college_name."','".$college_place."')");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "college added!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "college not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function editCollege($username,  $college_name, $college_place,$college_id){
		$response = array();

        $stmt = mysqli_query($this->conn, "update users_college set college_name = ' " .$college_name."' , college_place = '".$college_place."' where id = '".$college_id."' and username = '".$username."'  ");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "college Update!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "college not updated";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchCollegeByUsername($username)
	{
		$response = array();
		$response["colleges"] = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users_college where username = '".$username."'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "college found.";
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["colleges"],$row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No college found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchCollegeOfAllUsers($username)
	{
		$response = array();
		$response["colleges"] = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users_college ");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "college found.";
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["colleges"],$row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No college found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function deleteCollegeDetailsById($id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM users_college where id = '".$id."'");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "college details deleted.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "college details not deleted";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

}
