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



	public function registerUser($first_name, $last_name, $username, $email, $password)
	{
		$response = array();
		$link = "http://buzzerout.com/register-user.php";
		// 1.Generate Activation Link
		$unique = uniqid($username);
		// $unique = md5($unique);
		$link .= "?id=" . $unique;
		// 2.Generate Valid Timestamp -- Store To Database
		// Same Email cannot register again, to be checked( !!! Important)
		// Password Stored Should be Encrypted (!!! Important)
		$stmt = mysqli_query($this->conn, "insert into register(first_name,last_name,username,email,password,activation_link,valid_till)
		values('" . $first_name . "','" . $last_name . "','" . $username . "','" . $email . "','" . $password . "','" . $link . "',DATE_ADD(NOW(), INTERVAL + 6 DAY))");
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



	public function loginUser($username,  $password)
	{
		$response = array();

		$stmt = mysqli_query($this->conn,"select * from users where username='".$username."' and password ='".$password."' ");
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
	public function fetchProfileOfUser($username)
	{
		$response =$username;

		return $response;
	}
}
