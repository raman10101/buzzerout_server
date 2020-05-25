<?php

class UsersSocialController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UsersSocialService.php';
	}

	public function addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
	{
		$usersSocialService = new UsersSocialService();
		return $usersSocialService->addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
	}
	
	public function fetchSocialDetailsByUsername($username)
	{
		$usersSocialService = new UsersSocialService();
		return $usersSocialService->fetchSocialDetailsByUsername($username);
	}
	
	public function fetchSocialDetailsOfAllUsers($username)
	{
		$usersSocialService = new UsersSocialService();
		return $usersSocialService->fetchSocialDetailsOfAllUsers($username);
	}
	
	public function deleteSocialDetailsById($id,$username)
	{
		$usersSocialService = new UsersSocialService();
		return $usersSocialService->deleteSocialDetailsById($id, $username);
	}

	public function clearUsersSocial($username){
		$usersSocialService = new UsersSocialService();
		return $usersSocialService->clearUsersSocial($username);
	}

}
