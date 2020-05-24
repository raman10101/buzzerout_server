<?php 

class FileService{

    function __construct(){
        require_once dirname(__FILE__) . '/FileImp.php';
        require_once  './../User/UserController.php';
    }
    
    
    function uploafFile($product,$application,$from,$to,$message,$file, $username){
        //Check Username
      $user = new UserController();
      $authController = new AuthController();
      $response = array();
      if ($authController->authenticateUsernameInUser($username)["error"] == false) {
      $userResponse = $user->fetchUserByUsername($username);
      if($userResponse["error"] == true){
          $userResponse["message"] = "Please SigIn To upload";
          return $userResponse;
      }
		$fileImp = new FileImp();
		return $fileImp->uploafFile($product,$application,$from,$to,$message,$file);}else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
	} 

    function clearFiles($username){
        $fileImp = new FileImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
        return $fileImp->clearFiles(); }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }
}

?>