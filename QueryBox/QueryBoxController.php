<?php 

class QueryBoxController{

    function __construct(){
        require_once dirname(__FILE__) . '/QueryBoxService.php';
    }

    public function saveQuery($product,$application,$name,$email,$subject,$message){
		$queryBoxService = new QueryBoxService();
		return $queryBoxService->saveQuery($product,$application,$name,$email,$subject,$message);
	} 


}

?>