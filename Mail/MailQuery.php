<?php 

class MailQuery{

    private $conn;

    function __construct(){
        require_once  './../Config/Connect.php';
        require_once  './../Config/Constants.php';
        $db = new Connect();
        $this->conn = $db->connect();
    }
    public function sendMail($product,$application,$from,$to,$message,$subject){
        $response = array();

        $headers = 'From: '.$application.'' . "\r\n" .
        'Reply-To: '.$from.' ' . "\r\n" .
        'Mailed-By: '.$application.' ' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(!mail($to,$subject,$message, $headers)) {
            $response["error"] = true;
            $response["message"] = 'Message was not sent.';
            $response["info"] = 'Mailer error: ' . error_get_last()['message'];
        } else {
            $response["error"] = false;
            $response["message"] = 'Message has been sent.';
        }
        return $response;

        return $response;
	} 

}

?>