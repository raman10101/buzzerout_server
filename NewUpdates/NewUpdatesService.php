<?php
class NewUpdatesService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/NewUpdatesImp.php';
    }
    
    function fetchAllUpdates(){
		$newUpdatesImp = new NewUpdatesImp();
		return $newUpdatesImp->fetchAllUpdates();
	}
}