<?php 

class CommentController{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentService.php';
    }

	public function addComment($feed_id,  $user_id, $text){
		$commentService = new CommentService();
		return $commentService->addComment($feed_id,  $user_id, $text);
	}
	
	public function fetchAllComments(){
		$commentService = new CommentService();
		return $commentService->fetchAllComments();
	}
	
	public function clearComment(){
		$commentService = new CommentService();
		return $commentService->clearComment();
	}

}

?>