<?php

class UsersWorkController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UsersWorkService.php';
	}

	public function addWork($username,  $work_place, $work_profile)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->addWork($username,  $work_place, $work_profile);
	}
	
	public function fetchWorkByUsername($username)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->fetchWorkByUsername($username);
	}
	
	public function deleteWorkDetailsById($id)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->deleteWorkDetailsById($id);
	}

}
