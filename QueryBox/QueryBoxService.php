<?php 

class QueryBoxService{

    function __construct(){
        require_once dirname(__FILE__) . '/QueryBoxImp.php';
    }
    
    
    public function saveQuery($product,$application,$name,$email,$subject,$message){
		$queryBoxImp = new QueryBoxImp();
		return $queryBoxImp->saveQuery($product,$application,$name,$email,$subject,$message);
	} 

}

?>