<?php 

class QueryBoxImp{

    function __construct(){
        require_once dirname(__FILE__) . '/QueryBoxQuery.php';
    }
    public function saveQuery($product,$application,$name,$email,$subject,$message){
		$queryBoxQuery = new QueryBoxQuery();
		return $queryBoxQuery->saveQuery($product,$application,$name,$email,$subject,$message);
	} 

}

?>