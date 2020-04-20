<?php 

class CommentService{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentImp.php';
    }
	
    public function addComment($feed_id,  $user_id, $text){
        $commentImp = new CommentImp();
		return $commentImp->addComment($feed_id,  $user_id, $text);
    }
    
    public function fetchAllComments(){
		$commentImp = new CommentImp();
		return $commentImp->fetchAllComments();
    }
    
    public function clearComment(){
        $commentImp = new CommentImp();
		return $commentImp->clearComment();
    }

}

?>