<?php

class FeedController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/FeedService.php';
	}

	// New Buzz API
	public function createBuzz($username, $title, $description, $location)
	{
		$feedService = new FeedService();
		return $feedService->createBuzz($username, $title, $description, $location);
	}
	public function createBuzzAnonymously($username, $title, $description, $location)
	{
		$feedService = new FeedService();
		return $feedService->createBuzzAnonymously($username, $title, $description, $location);
	}

	public function uploadImageToBuzz($feed_id, $img, $username)
	{
		$feedService = new FeedService();
		return $feedService->uploadImageToBuzz($feed_id, $img, $username);
	}
	public function upvoteBuzz($username, $feedid, $up, $down)
	{
		$feedService = new FeedService();
		return $feedService->upvoteBuzz($username, $feedid, $up, $down);
	}
	public function downvoteBuzz($username, $feedid, $up, $down)
	{
		$feedService = new FeedService();
		return $feedService->downvoteBuzz($username, $feedid, $up, $down);
	}
	public function removeUpvoteBuzz($username, $feedid, $up, $down)
	{
		$feedService = new FeedService();
		return $feedService->removeUpvoteBuzz($username, $feedid, $up, $down);
	}
	public function removeDownvoteBuzz($username, $feedid, $up, $down)
	{
		$feedService = new FeedService();
		return $feedService->removeDownvoteBuzz($username, $feedid, $up, $down);
	}
	public function shareBuzz($username, $feedid, $description)
	{
		$feedService = new FeedService();
		return $feedService->shareBuzz($username, $feedid, $description);
	}
	public function hideBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->hideBuzz($username, $buzzid);
	}
	public function saveBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->saveBuzz($username, $buzzid);
	}
	public function followBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->followBuzz($username, $buzzid);
	}
	public function unfollowBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->unfollowBuzz($username, $buzzid);
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
	public function Fetchvotesonfeed($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchvotesonfeed($feedid);
	}
	public function Fetchallimageoffeed($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchallimageoffeed($feedid);
	}
	// Fetch Feed By Email
	public function Uploadfeedimage($feed_id, $img, $username)
	{
		$feedService = new FeedService();
		return $feedService->Uploadfeedimage($feed_id, $img, $username);
	}
	public function Uploadfeedvideo($feedid, $video, $username)
	{
		$feedService = new FeedService();
		return $feedService->Uploadfeedvideo($feedid, $video, $username);
	}
	public function Feedupvote($username, $feedid, $up, $down)
	{
		$feedService = new FeedService();
		return $feedService->Feedupvote($username, $feedid, $up, $down);
	}
	public function fetchAllFeed($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchAllFeed($username);
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
	public function Uploadfeed($username, $title, $description, $location)
	{
		$feedService = new FeedService();
		return $feedService->Uploadfeed($username, $title, $description, $location);
	}
	public function clearFeedByusername($username)
	{
		$feedService = new FeedService();
		return $feedService->clearFeedByusername($username);
	}
	public function Fetchallvideooffeed($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchallvideooffeed($feedid);
	}
	public function Fetchfeedinfo($feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedinfo($feedid);
	}
	public function feedDelete($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->feedDelete($feedid, $username);
	}
	public function imgdelete($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->imgdelete($feedid, $username);
	}
	public function videoDelete($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->videoDelete($feedid, $username);
	}
	public function voteDelete($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->voteDelete($feedid, $username);
	}
	public function clearFeedByFeedId($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->clearFeedByFeedId($feedid, $username);
	}
	public function Fetchvotesonfeedbyuser($feedid, $username)
	{
		$feedService = new FeedService();
		return $feedService->Fetchvotesonfeedbyuser($feedid, $username);
	}
	public function editFeed($username, $feed_id, $title, $description, $location)
	{
		$feedService = new FeedService();
		return $feedService->editFeed($username, $feed_id, $title, $description, $location);
	}
	public function fetchFeedByRole($role)
	{
		$feedService = new FeedService();
		return $feedService->fetchFeedByRole($role);
	}
}
