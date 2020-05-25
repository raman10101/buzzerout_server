<?php 

class CommentImp{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentQuery.php';
    }

    public function addComment($feed_id,  $username, $text){
        $commentQuery = new CommentQuery();
		return $commentQuery->addComment($feed_id,  $username, $text);
    }

    public function editComment($comment_id,  $username, $text){
      $commentQuery = new CommentQuery();
    return $commentQuery->editComment($comment_id,  $username, $text);
    }
    
    public function fetchCommentByFeed($username, $feed_id){
      $commentQuery = new CommentQuery();
    return $commentQuery->fetchCommentByFeed($username, $feed_id);
    }
    
    public function fetchAllComments($username){
		$commentQuery = new CommentQuery();
		return $commentQuery->fetchAllComments($username);
    }
    public function fetchCommentByCommentId($comment_id, $username){
      $commentQuery = new CommentQuery();
      return $commentQuery->fetchCommentByCommentId($comment_id, $username);
    }
    
    public function deleteCommentById($id, $username){
      $commentQuery = new CommentQuery();
      return $commentQuery->deleteCommentById($id, $username);
    }
    
    public function deleteCommentByFeedId($username, $feed_id){
      $commentQuery = new CommentQuery();
    return $commentQuery->deleteCommentByFeedId($username, $feed_id);
    }

    public function clearComment($username){
        $commentQuery = new CommentQuery();
		return $commentQuery->clearComment($username);
    }

}

?>