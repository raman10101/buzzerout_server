<?php

class UserdetailController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UserdetailService.php';
	}

	public function createUserDetail($username, $about_you, $other_name, $fav_quote)
	{
		$UserdetailService = new UserdetailService();
		return $UserdetailService->createUserDetail($username, $about_you, $other_name, $fav_quote);
	}
	public function fetchUserDetail($username)
	{
		$UserdetailService = new UserdetailService();
		return $UserdetailService->fetchUserDetail($username);
	}
	
	public function fetchUserDetailOfAllUsers($username)
	{
		$UserdetailService = new UserdetailService();
		return $UserdetailService->fetchUserDetailOfAllUsers($username);
	}
	public function updateUserDetails($username, $about_you, $other_name, $fav_quote)
	{
		$UserdetailService = new UserdetailService();
		return $UserdetailService->updateUserDetails($username, $about_you, $other_name, $fav_quote);
	}

}
