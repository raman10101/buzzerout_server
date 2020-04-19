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
		values('" . $first_name . "','" . $last_name . "','" . $username . "','" . $email . "','" . $password . "','" . $unique . "',DATE_ADD(NOW(), INTERVAL + 6 DAY))");
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

	public function fetchUserToRegisterByEmail($first_name, $last_name, $username, $email, $password)
	{
		$response = array();
		$stmt = mysqli_query($this->conn,"select * from users where email='".$email."'");
		if(mysqli_num_rows($stmt) > 0){
			$response["error"] = true;
			$response["users"] = array();
			while($row = mysqli_fetch_assoc($stmt)){
				array_push($response["users"],$row);
			}
			$response["message"] = "An Account is already present by the the same email.";
		}
		else{
			$stmt2 = mysqli_query($this->conn,"select * from register where email='".$email."'");
			if(mysqli_num_rows($stmt2) > 0){
				$stmt2 = mysqli_query($this->conn, "UPDATE register SET firstname = '" . $first_name . "', lastname= '" . $last_name . "', username - '" . $username . ", password ='" . $password . "', valid_till = ,DATE_ADD(NOW(), INTERVAL + 6 DAY)) WHERE email = '" . $email . "'");
				$response["error"] = true;
				$response["users"] = array();
				while($row = mysqli_fetch_assoc($stmt2)){
				array_push($response["users"],$row);
			}
				$response["message"] = "User is found in register table with same email , so the link is activated again!!!";
			}
			else{
				$response["error"] = false;
			}
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


	public function checkUsername($username)
	{
		$response = array();
		$stmt = mysqli_query($this->conn, "select *  FROM register " );
		$match = 0;
		if (mysqli_num_rows($stmt) > 0) {
			// check for the duplication of the username!!!
			
			while ($row = mysqli_fetch_assoc($stmt)) {
				if ($row['username'] == $username){
					$match = 1;
					$response["error"] = true;
					$response["message"] = "Username already exists!!!";
					break;
				}
			}
		}
		if ($match == 0){
			$stmt2 = mysqli_query($this->conn, "select *  FROM users ");
			if (mysqli_num_rows($stmt2) > 0) {
				// check for the duplication of the username!!!
				while ($row = mysqli_fetch_assoc($stmt2)) {
					if ($row['username'] == $username){
						$match = 1;
						$response["error"] = true;
						$response["message"] = "Username already exists!!!";
						break;
					}
				}
			}
		}
        if ($match == 0){
			$response["error"] = false;
            $response["message"] = "Username does not exists, can prceed with the current username";
		}
		return $response;
	}
}
?>