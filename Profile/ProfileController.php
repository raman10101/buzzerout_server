<?php

class ProfileController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/ProfileService.php';
	}

	public function createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);
	}
	public function fetchProfileOfUser($username)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->fetchProfileOfUser($username);
	}
	public function updateMobileAddress($username, $mobile, $address)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->updateMobileAddress($username, $mobile, $address);
	}
	public function updateDobGender($username, $dob, $gender)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->updateDobGender($username, $dob, $gender);
	}
}
