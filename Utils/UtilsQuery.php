<?php

class UtilsQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function lowercase($text)
	{
		$response=array();
		$response['error']=false;
		$response['old_username']=$text;
		$response['new_username']=strtolower($text);
		return $response;
	}
	public function noSpecialChar($text)
	{
		$response=array();
		if( !ctype_alnum( $text ) )
		{
			$response['error']=true;
			$response['message']="username contain special character";
		}else{
			$response['error']=false;
			$response['message']="username does not contain special character";
		}
		return strtolower($text);
	}
}
