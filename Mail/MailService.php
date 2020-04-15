<?php 

class MailService{

    function __construct(){
        require_once dirname(__FILE__) . '/MailImp.php';
    }
    

        
    public function sendMail($product,$application,$from,$to,$message,$subject){
		$mailImp = new MailImp();
		return $mailImp->sendMail($product,$application,$from,$to,$message,$subject);
	} 


}
