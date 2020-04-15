<?php 

class MessageBoxService{

    function __construct(){
        require_once dirname(__FILE__) . '/MessageBoxImp.php';
    }
    
    function storeMessage($product,$application,$from,$to,$message){
        $messageBoxImp= new MessageBoxImp();
        return $messageBoxImp->storeMessage($product,$application,$from,$to,$message);
    }
    function fetchMessages($product,$application,$user_id){
        $messageBoxImp= new MessageBoxImp();
        return $messageBoxImp->fetchMessages($product,$application,$user_id);
    }
    function setOnlineStatus($guest_id){
        $messageBoxImp= new MessageBoxImp();
        return $messageBoxImp->setOnlineStatus($guest_id);
    }
    function logoutOnlineStatus($guest_id){
        $messageBoxImp= new MessageBoxImp();
        return $messageBoxImp->logoutOnlineStatus($guest_id);
    }
    function fetchOnlineUsers($guest_id){
        $messageBoxImp= new MessageBoxImp();
        return $messageBoxImp->fetchOnlineUsers($guest_id);
    }
}

?>