<?php

class FeedController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/FeedService.php';
	}


	// Fethc Feed By Feedname
	public function Fetchfeedbylocation($location)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedbylocation($location);
	}
	// fetch feed by username
	public function Fetchfeedbyusername($username)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedbyusername($username);
	}
	public function Fetchvotesonpost($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchvotesonpost($feedid);
	}
	public function Fetchallimageoffeed($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchallimageoffeed($feedid);
	}
	// Fetch Feed By Email
	public function Uploadfeedimage($username,$title,$description,$location,$img)
	{
		$feedService = new FeedService();
		return $feedService->Uploadfeedimage($username,$title,$description,$location,$img);
	}
	public function Uploadfeedvideo($username, $title, $description, $location, $video)
	{
		$feedService = new FeedService();
		return $feedService->Uploadfeedvideo($username, $title, $description, $location, $video);
	}
	public function Feedupvote($username, $feedid,$up,$down)
	{
		$feedService = new FeedService();
		return $feedService->Feedupvote($username, $feedid,$up,$down);
	}
	public function fetchAllFeed()
	{
		$feedService = new FeedService();
		return $feedService->fetchAllFeed();
	}
	public function clearAllFeed()
	{
		$feedService = new FeedService();
		return $feedService->clearAllFeed();
	}
	public function clearFeedByLocation($location)
	{
		$feedService = new FeedService();
		return $feedService->clearFeedByLocation($location);
	}
}
