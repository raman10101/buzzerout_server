<?php

class MessageBoxQuery
{

    private $conn;

    function __construct()
    {
        require_once  './../Config/Connect.php';
        require_once  './../Config/Constants.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }

    function storeMessage($product,$application,$from,$to,$message){
        $response = array();
        $message_id = uniqid();
        $stmt = mysqli_query($this->conn,"insert into message_box(`message_id`,`product`,`application`,`from`,`to`,`message`,`timestamp`,`delivered`,`viewed`) Values('".$message_id."','".$product."','".$application."','".$from."','".$to."','".$message."',NOW(),0,0) ");

        if($stmt){
            $response["error"] = false;
            $response["message"] = "Message Sent";
        }else{
            $response["error"] = false;
            $response["message"] = "Message Could Not Be Sent";
            $response["info"] = mysqli_error($this->conn);
        }
        return $response;

    }
    function fetchMessages($product,$application,$user_id){
        $response = array();
        $stmt = mysqli_query($this->conn,"select `from`,`to`,`message`,`timestamp`,`delivered`,`viewed` from message_box where `product`='".$product."' and `application` = '".$application."' and (`from`= '".$user_id."' OR `to`='".$user_id."')  " );

        if(mysqli_num_rows($stmt) > 0){

            $response["error"] = false;
            $response["message"] = "Messages Found";
            $response["messages"] = [];
            while($row = mysqli_fetch_assoc($stmt)){
                array_push($response["messages"],$row);
            }
        }else{
            $response["error"] = true;
            $response["message"] = "Messages Not Found";
        }

        return $response;
    }

    function setOnlineStatus($guest_id){
        $response = array();
        $stmt = mysqli_query($this->conn, "insert into online_users (guest_id) values('".$guest_id."')");
        if($stmt){
            $response["error"] = false;
            $response["message"] = "User set online";
        }else{
            $response["error"] = true;
            $response["message"] = "User could not be set online";
        }
        return $response;
    }
    function logoutOnlineStatus($guest_id){
        $response = array();
        $stmt = mysqli_query($this->conn, "delete from online_users where guest_id = '".$guest_id."' ");
        if($stmt){
            $response["error"] = false;
            $response["message"] = "User set offline";
        }else{
            $response["error"] = true;
            $response["message"] = "User could not be set offline";
        }
        return $response;
    }
    function fetchOnlineUsers($guest_id){
        $response = array();
        $stmt = mysqli_query($this->conn,"select * from online_users where    guest_id <> '".$guest_id."'   " );

        if(mysqli_num_rows($stmt) > 0){

            $response["error"] = false;
            $response["message"] = "Users Found";
            $response["online_users"] = [];
            while($row = mysqli_fetch_assoc($stmt)){
                array_push($response["online_users"],$row);
            }
        }else{
            $response["error"] = true;
            $response["message"] = "Messages Not Found";
        }

        return $response;
    }
}
