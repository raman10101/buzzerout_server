<?php

class RegisterController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/RegisterService.php';
	}
	/**
	 * This Function is used for Registering Api
	 */
	public function registerUser($first_name, $last_name, $username, $email, $password, $role)
	{
		$registerService = new RegisterService();
		return $registerService->registeruser($first_name, $last_name, $username, $email, $password, $role);
	}

	public function activateRegisterUserLink($email)
	{
		$registerService = new RegisterService();
		return $registerService->activateRegisterUserLink($email);
	}

	public function allUsersToRegister()
	{
		$registerService = new RegisterService();
		return $registerService->allUsersToRegister();
	}

	public function clearRegister()
	{
		$registerService = new RegisterService();
		return $registerService->clearRegister();
	}
}
