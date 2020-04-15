<?php 

class MessageBoxController{

    function __construct(){
        require_once dirname(__FILE__) . '/MessageBoxService.php';
    }

    function storeMessage($product,$application,$from,$to,$message){
        $messageBoxService = new MessageBoxService();
        return $messageBoxService->storeMessage($product,$application,$from,$to,$message);
    }
    function fetchMessages($product,$application,$user_id){
        $messageBoxService = new MessageBoxService();
        return $messageBoxService->fetchMessages($product,$application,$user_id);
    }
    function setOnlineStatus($guest_id){
        $messageBoxService = new MessageBoxService();
        return $messageBoxService->setOnlineStatus($guest_id);
    }
    function logoutOnlineStatus($guest_id){
        $messageBoxService = new MessageBoxService();
        return $messageBoxService->logoutOnlineStatus($guest_id);
    }
    function fetchOnlineUsers($guest_id){
        $messageBoxService = new MessageBoxService();
        return $messageBoxService->fetchOnlineUsers($guest_id);
    }
    
}

?>