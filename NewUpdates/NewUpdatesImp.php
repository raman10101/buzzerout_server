<?php

class NewUpdatesImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/NewUpdatesQuery.php';
    }


    function fetchAllUpdates(){
		$newUpdatesQuery = new NewUpdatesQuery();
		return $newUpdatesQuery->fetchAllUpdates();
	}

}
