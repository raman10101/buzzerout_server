<?php

class NewUpdatesController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/NewUpdatesService.php';
	}


	function fetchAllUpdates(){
		$newUpdatesService = new NewUpdatesService();
		return $newUpdatesService->fetchAllUpdates();
	}

	
}
