<?php 

class MessageBoxImp{

    function __construct(){
        require_once dirname(__FILE__) . '/MessageBoxQuery.php';
    }
    function storeMessage($product,$application,$from,$to,$message){
        $messageBoxQuery= new MessageBoxQuery();
        return $messageBoxQuery->storeMessage($product,$application,$from,$to,$message);
    }
    function fetchMessages($product,$application,$user_id){
        $messageBoxQuery= new MessageBoxQuery();
        return $messageBoxQuery->fetchMessages($product,$application,$user_id);
    }

    function setOnlineStatus($guest_id){
        $messageBoxQuery= new MessageBoxQuery();
        return $messageBoxQuery->setOnlineStatus($guest_id);
    }

    function logoutOnlineStatus($guest_id){
        $messageBoxQuery= new MessageBoxQuery();
        return $messageBoxQuery->logoutOnlineStatus($guest_id);
    }
    function fetchOnlineUsers($guest_id){
        $messageBoxQuery= new MessageBoxQuery();
        return $messageBoxQuery->fetchOnlineUsers($guest_id);
    }
}

?>