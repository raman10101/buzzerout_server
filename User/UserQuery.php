<?php

class UserQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function loginUserWithUsername($username,  $password)
	{
		$response = array();

		$stmt = mysqli_query($this->conn,"select username, email,timestamp, role from users where username='".$username."' and password ='".$password."' ");
		if(mysqli_num_rows($stmt) > 0){
			$response["error"] = false;
			$response["message"] = "User Found";
			$response["user"] = mysqli_fetch_assoc($stmt);
		}else{
			$response["error"] = true;
			$response["message"] = "User Not found";
		}
		return $response;
	}
	
	public function loginUserWithEmail($username,  $password)
	{
		$response = array();

		$stmt = mysqli_query($this->conn,"select * from users where email='".$username."' and password ='".$password."' ");
		if(mysqli_num_rows($stmt) > 0){
			$response["error"] = false;
			$response["message"] = "User Found";
			$response["user"] = mysqli_fetch_assoc($stmt);
		}else{
			$response["error"] = true;
			$response["message"] = "User Not found";
		}
		return $response;
	}

	public function fetchUserByUsername($username)
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users where username = '". $username. "'");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "User found.";
            $response['user'] = $stmt->fetch_assoc();
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No user found.";
		}
		return $response;
	}

	public function fetchUserByEmail($email)
	{
		$response = array();
		$stmt = mysqli_query($this->conn,"select * from users where email='".$email."'");
		if(mysqli_num_rows($stmt) > 0){
			$response["error"] = false;
			$response["users"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["users"],$row);
			}
			$response["message"] = "User found";
		}
		else{
			$response["error"] = true;
			$response['message'] = "No user found"; 
		}
		return $response;
	}
	
	public function fetchAllUsers()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM users ");
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "Users found.";
            $response["users"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["users"],$row);
			}
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No user found.";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function clearUser()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM users;");
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
	public function updateFirstLastName($username, $first_name, $last_name){
		$response = array();
		$stmt = mysqli_query($this->conn,"update users_profile set first_name = '".$first_name."', last_name = '".$last_name."' where username = '".$username."'  ");
		if($stmt){  
            $response["error"] = false;
            $response["message"] = "Updated Successfully.";
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "Not Updated";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}

	public function forgotPassword($email)
	{
		$response = array();
		$link = "http://buzzerout.com/user-forgot-password.php";
		// 1.Generate Activation Link
		$unique = uniqid($email);
		// $unique = md5($unique);
		$link .= "?id=" . $unique;
		// 2.Generate Valid Timestamp -- Store To Database
		// Same Email cannot register again, to be checked( !!! Important)
		// Password Stored Should be Encrypted (!!! Important)
		// $stmt = mysqli_query($this->conn, "insert into forgot_password(email,activation_link,valid_till)
		// values('" . $email . "','" . $unique . "', DATE_ADD(NOW(), INTERVAL + 1 DAY))");
		// 3.Send Mail
		if (true) {
			// Inserted Record in database
			// Send Mail'
			$application = "BuzzerOut";
			$from = "raman.10101@gmail.com";
			$to = $email;
			$subject = "Password reset link";
			$message = $link;
			$headers = 'From: ' . $application . '' . "\r\n" .
				'Reply-To: ' . $from . ' ' . "\r\n" .
				'Mailed-By: ' . $application . ' ' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			if (!mail($to, $subject, $message, $headers)) {
				$response["error"] = true;
				$response["message"] = 'Email was not sent.';
				$response["info"] = 'Mailer error: ' . error_get_last()['message'];
			} else {
				$response["error"] = false;
				$response["message"] = 'Email has been sent.';
			}
		} else {
			// Not Inserted (Write Condition Here)
			$response["error"] = true;
			$response["message"] = 'Something Went Wrong.';
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
}
