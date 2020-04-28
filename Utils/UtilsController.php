<?php

class UtilsController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UtilsService.php';
	}

	public function lowerCase($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->lowerCase($text);
	}
	public function noSpecialChar($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->noSpecialChar($text);
	}
	public function parseUsernmae($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->parseUsernmae($text);
	}
	public function passwordLenght($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->passwordLenght($text);
	}
	public function passwordEncrypt($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->passwordEncrypt($text);
	}
	public function passwordDecrypt($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->passwordDecrypt($text);
	}
}
