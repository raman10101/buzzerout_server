<?php 

class CommentImp{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentQuery.php';
    }

    public function addComment($feed_id,  $user_id, $text){
        $commentQuery = new CommentQuery();
		return $commentQuery->addComment($feed_id,  $user_id, $text);
    }
    
    public function fetchAllComments(){
		$commentQuery = new CommentQuery();
		return $commentQuery->fetchAllComments();
    }

    public function clearComment(){
        $commentQuery = new CommentQuery();
		return $commentQuery->clearComment();
    }

}

?>