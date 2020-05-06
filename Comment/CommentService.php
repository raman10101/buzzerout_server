<?php 

class CommentService{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentImp.php';
        require_once  './../User/UserController.php';
    }
	
    public function addComment($feed_id,  $user_id, $text){

      //Check Username
      $user = new UserController();
      $userResponse = $user->fetchUserByUsername($user_id);
      if($userResponse["error"] == true){
          $userResponse["message"] = "Please SigIn To add a comment";
          return $userResponse;
      }
        $commentImp = new CommentImp();
		return $commentImp->addComment($feed_id,  $user_id, $text);
    }

    public function editComment($comment_id,  $user_id, $text){
      //Check Username
      $user = new UserController();
      $userResponse = $user->fetchUserByUsername($user_id);
      if($userResponse["error"] == true){
          $userResponse["message"] = "Please SigIn To edit a comment";
          return $userResponse;
      }
      $commentImp = new CommentImp();
    return $commentImp->editComment($comment_id,  $user_id, $text);
    }
    
    public function fetchCommentByFeed($feed_id){
      $commentImp = new CommentImp();
      return $commentImp->fetchCommentByFeed($feed_id);
      }
    
    public function fetchAllComments(){
		$commentImp = new CommentImp();
		return $commentImp->fetchAllComments();
    }
    
    public function deleteComment($id, $username){
      //Check Username
      $user = new UserController();
      $userResponse = $user->fetchUserByUsername($username);
      if($userResponse["error"] == true){
          $userResponse["message"] = "Please SigIn To delete a comment";
          return $userResponse;
      }
      $commentImp = new CommentImp();
      return $commentImp->deleteComment($id, $username);
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