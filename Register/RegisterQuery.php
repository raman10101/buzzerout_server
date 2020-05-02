<?php

class RegisterQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}



	public function registerUser($first_name, $last_name, $username, $email, $password, $role)
	{
		$response = array();
		$link = "http://buzzerout.com/register-user.php";
		// 1.Generate Activation Link
		$unique = uniqid($username);
		$link .= "?id=" . $unique;
		$stmt = mysqli_query($this->conn, "insert into register(first_name,last_name,username,email,password,activation_link,valid_till, role)
		values('" . $first_name . "','" . $last_name . "','" . $username . "','" . $email . "','" . $password . "','" . $unique . "',DATE_ADD(NOW(), INTERVAL + 6 DAY)),'" . $role . "'");
		// 3.Send Mail
		if ($stmt) {
			// Inserted Record in database
			// Send Mail'
			$application = "BuzzerOut";
			$from = "raman.10101@gmail.com";
			$to = $email;
			$subject = "User Registration";
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

	public function fetchUserToRegisterByEmail($email)
	{
		$response = array();
		$stmt = mysqli_query($this->conn,"select * from register where email='".$email."'");
		if(mysqli_num_rows($stmt) > 0){
			$response['error'] = false;
			$response["users"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["users"],$row);
			}
		}
		else{
			$response["error"] = true;
			$response['error'] = "No user found";
		}	
		return $response;
	}
	
	public function checkForUpdate($email, $username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn,"select * from register where username='".$username."' and email !='".$email."'");
		if(mysqli_num_rows($stmt) > 0){
			$response['error'] = false;
			$response["users"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["users"],$row);
			}
		}
		else{
			$response["error"] = true;
			$response['error'] = "No user found";
		}	
		return $response;
	}
	
	public function updateUserInRegister($first_name, $last_name, $username, $email, $password, $role)
	{
		$response = array();
		$link = "http://buzzerout.com/register-user.php";
		// 1.Generate Activation Link
		$unique = uniqid($username);
		// $unique = md5($unique);
		$link .= "?id=" . $unique;
		$stmt = mysqli_query($this->conn, "UPDATE register SET firstname = '" . $first_name . "', role= '" . $role . "', lastname= '" . $last_name . "',activation_link='".$unique."',  username - '" . $username . ", password ='" . $password . "', valid_till = ,DATE_ADD(NOW(), INTERVAL + 6 DAY)) WHERE email = '" . $email . "'");
		if ($stmt) {
			// Updated Record in database
			// Send Mail'
			$application = "BuzzerOut";
			$from = "raman.10101@gmail.com";
			$to = $email;
			$subject = "User Registration";
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
			// Not Updated (Write Condition Here)
			$response["error"] = true;
			$response["message"] = 'Something Went Wrong.';
			$response["info"] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function allUsersToRegister()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "select *  FROM register ");
        $response['data'] = array();
		if(mysqli_num_rows($stmt) > 0){  
            $response["error"] = false;
            $response["message"] = "ALL users to register.";
            while($row = $stmt->fetch_assoc()){
                array_push($response['data'],$row );
            }
        }
        else
        {
			$response["error"] = true;
            $response["message"] = "No Address";
            $response['info'] = mysqli_error($this->conn);
		}
		return $response;
	}
	
	public function clearRegister()
	{
		$response = array();
        $stmt = mysqli_query($this->conn, "DELETE FROM register");
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


	public function fetchUsernameInRegister($username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select *  FROM register where username = '".$username."'");
		if (mysqli_num_rows($stmt) > 0) {
			// check for the duplication of the username!!!
			$response["error"] = false;
			$response["message"] = "Username already exists!!!";
		}
        else{
			$response["error"] = true;
            $response["message"] = "Username does not exists, can prceed with the current username";
		}
		return $response;
	}
}
?>