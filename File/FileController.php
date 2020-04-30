<?php 

class FileController{

    function __construct(){
        require_once dirname(__FILE__) . '/FileService.php';
    }

    function uploafFile($product,$application,$from,$to,$message,$file, $username){
		$fileQuery = new FileService();
		return $fileQuery->uploafFile($product,$application,$from,$to,$message,$file, $username);
	} 
    function clearFiles(){
        $fileQuery = new FileService();
		return $fileQuery->clearFiles(); 
    }

}

?>