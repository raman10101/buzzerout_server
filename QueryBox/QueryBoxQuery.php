<?php

class QueryBoxQuery
{

    private $conn;

    function __construct()
    {
        require_once  './../Config/Connect.php';
        require_once  './../Config/Constants.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }

    function saveQuery($product,$application,$name,$email,$subject,$message){
        $response = array();
        
        $stmt= mysqli_query($this->conn,"insert into `".$product."`.`query_box` (name , email, subject, message, timestamp)
        values('".$name."','".$email."','".$subject."','".$message."',NOW()) ");
        if($stmt){
            $response["error"] = false;
            $response["message"] = "Query saved";
        }else{
            $response["error"] = true;
            $response["message"] = "Query could not be saved";
            $response["info"] = mysqli_error($this->conn);
        }

        return $response;
    }

}
