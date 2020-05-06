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
	public function updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital){
		$profileService = new ProfileService();
		return $profileService->updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital);
	}
	public function fetchProfileOfUser($username)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->fetchProfileOfUser($username);
	}
	
	public function fetchProfileOfAllUsers($username)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->fetchProfileOfAllUsers($username);
	}
	public function updateMobileAddress($username, $mobile, $address)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->updateMobileAddress($username, $mobile, $address);
	}
	public function updateDobGender($username, $dob,$uob, $gender)
	{
		$ProfileService = new ProfileService();
		return $ProfileService->updateDobGender($username, $dob,$uob, $gender);
	}
	public function createEmptyProfileOfUser($username)
    {
        $ProfileService = new ProfileService();
		return $ProfileService->createEmptyProfileOfUser($username);
	}
	public function updateUserProfileImage($username,$img)
    {
        $ProfileService = new ProfileService();
		return $ProfileService->updateUserProfileImage($username,$img);
	}
	public function updateUserTimelineImage($username,$img)
    {
        $ProfileService = new ProfileService();
		return $ProfileService->updateUserTimelineImage($username,$img);
	}
}
