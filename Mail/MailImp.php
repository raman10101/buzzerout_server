<?php 

class MailImp{

    function __construct(){
        require_once dirname(__FILE__) . '/MailQuery.php';
    }

    public function sendMail($product,$application,$from,$to,$message,$subject){
		$mailQuery = new MailQuery();
		return $mailQuery->sendMail($product,$application,$from,$to,$message,$subject);
	} 

}
