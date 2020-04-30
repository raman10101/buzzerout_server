<?php 

class FileService{

    function __construct(){
        require_once dirname(__FILE__) . '/FileImp.php';
        require_once  './../User/UserController.php';
    }
    
    
    function uploafFile($product,$application,$from,$to,$message,$file, $username){
        //Check Username
      $user = new UserController();
      $userResponse = $user->fetchUserByUsername($username);
      if($userResponse["error"] == true){
          $userResponse["message"] = "Please SigIn To upload";
          return $userResponse;
      }
		$fileImp = new FileImp();
		return $fileImp->uploafFile($product,$application,$from,$to,$message,$file);
	} 

    function clearFiles(){
        $fileImp = new FileImp();
		return $fileImp->clearFiles(); 
    }
}

?>