<?php 

class CommentController{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentService.php';
    }

	public function addComment($feed_id,  $username, $text){
		$commentService = new CommentService();
		return $commentService->addComment($feed_id,  $username, $text);
	}

	public function editComment($comment_id,  $username, $text){
		$commentService = new CommentService();
		return $commentService->editComment($comment_id,  $username, $text);
	}
	
	public function fetchCommentByFeed($username, $feed_id){
		$commentService = new CommentService();
		return $commentService->fetchCommentByFeed($username, $feed_id);
	}
	
	public function fetchCommentByCommentId($comment_id, $username){
		$commentService = new CommentService();
		return $commentService->fetchCommentByCommentId($comment_id, $username);
	}
	
	public function fetchAllComments($username){
		$commentService = new CommentService();
		return $commentService->fetchAllComments($username);
	}
	
	public function deleteCommentById($id, $username){
		$commentService = new CommentService();
		return $commentService->deleteCommentById($id, $username);
	}
	
	public function deleteCommentByFeedId($username, $feed_id){
		$commentService = new CommentService();
		return $commentService->deleteCommentByFeedId($username, $feed_id);
	}
	
	public function clearComment($username){
		$commentService = new CommentService();
		return $commentService->clearComment($username);
	}
	
}

?>