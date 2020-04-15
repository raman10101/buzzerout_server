<?php 

class MailController{

    function __construct(){
        require_once dirname(__FILE__) . '/MailService.php';
    }

    public function sendMail($product,$application,$from,$to,$message,$subject){
		$mailQuery = new MailService();
		return $mailQuery->sendMail($product,$application,$from,$to,$message,$subject);
	} 


}

?>