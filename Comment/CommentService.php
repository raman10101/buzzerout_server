<?php 

class CommentService{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentImp.php';
    }
	
    public function addComment($feed_id,  $user_id, $text){
        $commentImp = new CommentImp();
		return $commentImp->addComment($feed_id,  $user_id, $text);
    }

    public function editComment($feed_id,  $user_id, $text){
      $commentImp = new CommentImp();
    return $commentImp->editComment($feed_id,  $user_id, $text);
    }
    
    public function fetchCommentByFeed($feed_id){
      $commentImp = new CommentImp();
      return $commentImp->fetchCommentByFeed($feed_id);
      }
    
    public function fetchAllComments(){
		$commentImp = new CommentImp();
		return $commentImp->fetchAllComments();
    }
    
    public function deleteComment($id){
      $commentImp = new CommentImp();
      return $commentImp->deleteComment($id);
      }
      
    public function deleteCommentByFeedId($feed_id){
      $commentImp = new CommentImp();
      return $commentImp->deleteCommentByFeedId($feed_id);
      }
    
    public function clearComment(){
        $commentImp = new CommentImp();
		return $commentImp->clearComment();
    }

}

?>