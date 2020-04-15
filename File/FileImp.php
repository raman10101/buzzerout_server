<?php 

class FileImp{

    function __construct(){
        require_once dirname(__FILE__) . '/FileQuery.php';
    }
    function uploafFile($product,$application,$from,$to,$message,$file){
		$fileQuery = new FileQuery();
		return $fileQuery->uploafFile($product,$application,$from,$to,$message,$file);
    } 
    function clearFiles(){
        $fileQuery = new FileQuery();
		return $fileQuery->clearFiles(); 
    }

}

?>