<?php 

class FileController{

    function __construct(){
        require_once dirname(__FILE__) . '/FileService.php';
    }

    function uploafFile($product,$application,$from,$to,$message,$file){
		$fileQuery = new FileService();
		return $fileQuery->uploafFile($product,$application,$from,$to,$message,$file);
	} 
    function clearFiles(){
        $fileQuery = new FileService();
		return $fileQuery->clearFiles(); 
    }

}

?>