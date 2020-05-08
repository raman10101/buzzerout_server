<?php 

class CommentController{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentService.php';
    }

	public function addComment($feed_id,  $user_id, $text){
		$commentService = new CommentService();
		return $commentService->addComment($feed_id,  $user_id, $text);
	}

	public function editComment($comment_id,  $user_id, $text){
		$commentService = new CommentService();
		return $commentService->editComment($comment_id,  $user_id, $text);
	}
	
	public function fetchCommentByFeed($feed_id){
		$commentService = new CommentService();
		return $commentService->fetchCommentByFeed($feed_id);
	}
	
	public function fetchCommentByCommentId($comment_id, $username){
		$commentService = new CommentService();
		return $commentService->fetchCommentByCommentId($comment_id, $username);
	}
	
	public function fetchAllComments(){
		$commentService = new CommentService();
		return $commentService->fetchAllComments();
	}
	
	public function deleteCommentById($id, $username){
		$commentService = new CommentService();
		return $commentService->deleteCommentById($id, $username);
	}
	
	public function deleteCommentByFeedId($feed_id){
		$commentService = new CommentService();
		return $commentService->deleteCommentByFeedId($feed_id);
	}
	
	public function clearComment(){
		$commentService = new CommentService();
		return $commentService->clearComment();
	}
	
}

?>