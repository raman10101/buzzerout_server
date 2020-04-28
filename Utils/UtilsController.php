<?php

class UtilsController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/UtilsService.php';
	}

	public function lowercase($text)
	{
		$UtilsService = new UtilsService();
		return $UtilsService->lowercase($text);
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
}
