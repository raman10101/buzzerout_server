<?php 

class CommentService{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentImp.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
	
    public function addComment($feed_id,  $user_id, $text){

      //Check Username
      $authController = new AuthController();
      if ($authController->authenticateUsernameInUser($user_id)["error"] == false) {
        $commentImp = new CommentImp();
        $response = $commentImp->addComment($feed_id,  $user_id, $text);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
		return $response;
    }

    public function editComment($comment_id,  $user_id, $text){
      
      //Check Username
      $authController = new AuthController();
      if ($authController->authenticateUsernameInUser($user_id)["error"] == false) {
        $commentImp = new CommentImp();
        $response = $commentImp->editComment($comment_id,  $user_id, $text);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
    return $response;
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
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->deleteComment($id, $username);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
    return $response;
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