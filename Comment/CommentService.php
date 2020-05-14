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
        $commentController = new CommentController();
        $response = $commentImp->addComment($feed_id,  $user_id, $text);
        if($response['error'] == false){
          $response['comments'] = $commentController->fetchCommentByFeed($feed_id)['comments'];
        }
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
        $commentController = new CommentController();
        $response = $commentImp->editComment($comment_id,  $user_id, $text);
        if($response['error'] == false){
          $commentResp = $commentController->fetchCommentByCommentId($comment_id, $user_id);
          if($commentResp['error'] == false){
            $feed_id = $commentResp['comments'][0]['feed_id'];
            $resp = $commentController->fetchCommentByFeed($feed_id);
            if($resp['error'] == false){
              $response['comments'] = $resp['comments'];
            }
            else{
              $response['error'] = true;
              $response['message'] = "error in fetching the comment";
            }
          }
          else{
            $response['error'] = true;
            $response['message'] = "error in fetching the comment";
          }
        }
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
    
    public function fetchCommentByCommentId($comment_id, $username){
      $commentImp = new CommentImp();
      return $commentImp->fetchCommentByCommentId($comment_id, $username);
    }
    
    public function fetchAllComments(){
		$commentImp = new CommentImp();
		return $commentImp->fetchAllComments();
    }
    
    public function deleteCommentById($id, $username){
     //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->deleteCommentById($id, $username);
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