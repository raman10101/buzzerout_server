<?php

class UsersWorkQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function addWork($username,  $work_place, $work_profile)
	{
		$response = array();

        $stmt = mysqli_query($this->conn, "insert into users_work (username,work_place,work_profile) values('".$username."','".$work_place."','".$work_profile."')");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "work details added!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "work details not added";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function editWork($username,  $work_place, $work_profile,$work_id){
		$response = array();

        $stmt = mysqli_query($this->conn, "update users_work set work_place  ='".$work_place."', work_profile = '".$work_profile."' where id = '".$work_id."'  and username = '".$username."'   ");
        if($stmt){
			$response["error"] = false;
			$response["message"] = "work details updated!!";
        }
        else{
			$response["error"] = true;
			$response["message"] = "work details not updated";
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function fetchWorkByUsername($username)
	{
		$response = array();
		$response["works"] = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users_work where username = '".$username."'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "work details found.";
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["works"],$row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No work_details found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function deleteWorkDetailsById($id)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM users_work where id = '".$id."'");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "work details deleted.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "work details not deleted";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

}
