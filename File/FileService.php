<?php 

class FileService{

    function __construct(){
        require_once dirname(__FILE__) . '/FileImp.php';
    }
    
    
    function uploafFile($product,$application,$from,$to,$message,$file){
		$fileImp = new FileImp();
		return $fileImp->uploafFile($product,$application,$from,$to,$message,$file);
	} 

    function clearFiles(){
        $fileImp = new FileImp();
		return $fileImp->clearFiles(); 
    }
}

?>