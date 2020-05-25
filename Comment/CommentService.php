<?php 

class CommentService{

    function __construct(){
        require_once dirname(__FILE__) . '/CommentImp.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
	
    public function addComment($feed_id,  $username, $text){
      $response = array();
      //Check Username
      $authController = new AuthController();
      if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $commentImp = new CommentImp();
        $commentController = new CommentController();
        $response = $commentImp->addComment($feed_id,  $username, $text);
        if($response['error'] == false){
          $response['comments'] = $commentController->fetchCommentByFeed($username, $feed_id)['comments'];
        }
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
		return $response;
    }

    public function editComment($comment_id,  $username, $text){
      $response = array();
      //Check Username
      $authController = new AuthController();
      if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        $commentImp = new CommentImp();
        $commentController = new CommentController();
        $response = $commentImp->editComment($comment_id,  $username, $text);
        if($response['error'] == false){
          $commentResp = $commentController->fetchCommentByCommentId($comment_id, $username);
          if($commentResp['error'] == false){
            $feed_id = $commentResp['comments'][0]['feed_id'];
            $resp = $commentController->fetchCommentByFeed($username, $feed_id);
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
    
    public function fetchCommentByFeed($username, $feed_id){
      $response = array();
      //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->fetchCommentByFeed($username, $feed_id);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
      return $response;
      }
    
    public function fetchCommentByCommentId($comment_id, $username){
      $response = array();
      //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->fetchCommentByCommentId($comment_id, $username);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
      return $response;
    }
    
    public function fetchAllComments($username){
      $response = array();
       //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->fetchAllComments($username);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
      return $response;
    }
    
    public function deleteCommentById($id, $username){
      $response = array();
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
      
    public function deleteCommentByFeedId($username, $feed_id){
      $response = array();
      //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->deleteCommentByFeedId($username, $feed_id);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
      return $response;
    }
    
    public function clearComment($username){
      $response = array();
       //Check Username
     $authController = new AuthController();
     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $commentImp = new CommentImp();
      $response =  $commentImp->clearComment($username);
      }
      else{
        $response["error"] = true;
        $response["message"] = "User Not Found";
      }
      return $response;
    }
}

?>