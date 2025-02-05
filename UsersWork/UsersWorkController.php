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
	public function editWork($username,  $work_place, $work_profile,$work_id){
		$usersworkService = new UsersWorkService();
		return $usersworkService->editWork($username,  $work_place, $work_profile,$work_id);
	}
	
	public function fetchWorkByUsername($username)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->fetchWorkByUsername($username);
	}
	
	public function fetchWorkOfAllUsers($username)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->fetchWorkOfAllUsers($username);
	}
	
	public function deleteWorkDetailsById($id, $username)
	{
		$usersworkService = new UsersWorkService();
		return $usersworkService->deleteWorkDetailsById($id, $username);
	}

	public function clearUsersWork($username){
		$usersworkService = new UsersWorkService();
		return $usersworkService->clearUsersWork($username);
	}

}
