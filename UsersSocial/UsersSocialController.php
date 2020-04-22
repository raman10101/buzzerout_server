<?php

class UsersSocialController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UsersSocialService.php';
	}

	public function addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube)
	{
		$userssocialervice = new UsersSocialService();
		return $userssocialervice->addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
	}
	
	public function fetchSocialDetailsByUsername($username)
	{
		$userssocialervice = new UsersSocialService();
		return $userssocialervice->fetchSocialDetailsByUsername($username);
	}
	
	public function deleteSocialDetailsById($id)
	{
		$userssocialervice = new UsersSocialService();
		return $userssocialervice->deleteSocialDetailsById($id);
	}

}
