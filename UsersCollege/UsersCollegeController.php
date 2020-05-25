<?php

class UsersCollegeController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UsersCollegeService.php';
	}

	public function addCollege($username,  $college_name, $college_place)
	{
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->addCollege($username,  $college_name, $college_place);
	}
	
	public function fetchCollegeByUsername($username)
	{
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->fetchCollegeByUsername($username);
	}
	
	public function fetchCollegeOfAllUsers($username)
	{
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->fetchCollegeOfAllUsers($username);
	}
	
	public function fetchCollegeById($username, $college_id)
	{
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->fetchCollegeById($username, $college_id);
	}

	public function deleteCollegeDetailsById($id, $username)
	{
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->deleteCollegeDetailsById($id, $username);
	}

	public function editCollege($username,  $college_name, $college_place,$college_id){
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->editCollege($username,  $college_name, $college_place,$college_id);
	}

	public function clearUsersCollege($username){
		$userscollegeService = new UsersCollegeService();
		return $userscollegeService->clearUsersCollege($username);
	}

}
