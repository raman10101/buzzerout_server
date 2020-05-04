<?php 

class AuthQuery{

    private $conn;

    function __construct(){
        require_once  './../Config/Connect.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }
    
    public function authenticateEmailInUser($email){    
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from users where email = '".$email."' ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }
    public function authenticateUsernameInUser($username){
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from users where username = '".$username."' ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }
    public function authenticateUsernameEmailInUser($username, $email){
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from users where username = '".$username."' and email = '".$email."'  ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }
    public function authenticateEmailInRegister($email){
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from register where email = '".$email."' ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }
    public function authenticateUsernameInRegister($username){
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from register where username = '".$username."' ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }
    public function authenticateUsernameEmailInRegister($username, $email){
        $response = array();

        $stmt = mysqli_query($this->conn, "select * from register where username = '".$username."' and email = '".$email."'  ");
        if(mysqli_num_rows($stmt) > 0){
            $response["error"] = false;
        }else{
            $response['error'] = true;
        }

        return $response;
    }



}

?>