<?php

class FollowController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/FollowService.php';
	}


	// Fethc Follow By Followname
	public function newFollow($by, $to)
	{
		$followService = new FollowService();
		return $followService->newFollow($by, $to);
	}
	public function fetchFollowing($username)
	{
		$followService = new FollowService();
		return $followService->fetchFollowing($username);
	}
	public function fetchFollowedBy($username)
	{
		$followService = new FollowService();
		return $followService->fetchFollowedBy($username);
	}
	public function deleteFollowing($username, $to)
	{
		$followService = new FollowService();
		return $followService->deleteFollowing($username, $to);
	}
	public function deleteFollower($username, $by)
	{
		$followService = new FollowService();
		return $followService->deleteFollower($username, $by);
	}
	public function deleteUserConnections($username)
	{
		$followService = new FollowService();
		return $followService->deleteUserConnections($username);
	}
	public function deleteAllFollow()
	{
		$followService = new FollowService();
		return $followService->deleteAllFollow();
	}
}
