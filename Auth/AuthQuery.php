<?php 

class AuthQuery{

    private $conn;

    function __construct(){
        require_once  './../Config/Connect.php';
        require_once  './../Config/Constants.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }
 

}

?>