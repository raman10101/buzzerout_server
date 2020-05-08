<?php 

class CommentImp{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentQuery.php';
    }

    public function addComment($feed_id,  $user_id, $text){
        $commentQuery = new CommentQuery();
		return $commentQuery->addComment($feed_id,  $user_id, $text);
    }

    public function editComment($comment_id,  $user_id, $text){
      $commentQuery = new CommentQuery();
    return $commentQuery->editComment($comment_id,  $user_id, $text);
    }
    
    public function fetchCommentByFeed($feed_id){
      $commentQuery = new CommentQuery();
    return $commentQuery->fetchCommentByFeed($feed_id);
    }
    
    public function fetchAllComments(){
		$commentQuery = new CommentQuery();
		return $commentQuery->fetchAllComments();
    }
    public function fetchCommentByCommentId($comment_id, $username){
      $commentQuery = new CommentQuery();
      return $commentQuery->fetchCommentByCommentId($comment_id, $username);
    }
    
    public function deleteCommentById($id, $username){
      $commentQuery = new CommentQuery();
      return $commentQuery->deleteCommentById($id, $username);
    }
    
    public function deleteCommentByFeedId($feed_id){
      $commentQuery = new CommentQuery();
    return $commentQuery->deleteCommentByFeedId($feed_id);
    }

    public function clearComment(){
        $commentQuery = new CommentQuery();
		return $commentQuery->clearComment();
    }

}

?>