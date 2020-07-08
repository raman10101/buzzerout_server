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
	public function unShareBuzz($username, $feedid){
		$feedService = new FeedService();
		return $feedService->unShareBuzz($username, $feedid);
	}
	public function hideBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->hideBuzz($username, $buzzid);
	}
	
	public function unHideBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->unHideBuzz($username, $buzzid);
	}
	public function saveBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->saveBuzz($username, $buzzid);
	}
	public function unSaveBuzz($username, $buzzid)
	{
		$feedService = new FeedService();
		return $feedService->unSaveBuzz($username, $buzzid);
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
	public function fetchHideBuzz($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchHideBuzz($username);
	}
	public function fetchSaveBuzz($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchSaveBuzz($username);
	}
	public function fetchShareBuzz($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchShareBuzz($username);
	}








	// Fethc Feed By Feedname
	public function Fetchfeedbylocation($username,$location)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedbylocation($username,$location);
	}
	// fetch feed by username
	public function Fetchfeedbyusername($username)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedbyusername($username);
	}
	public function Fetchvotesonfeed($username,$feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchvotesonfeed($username,$feedid);
	}
	public function Fetchallimageoffeed($username,$feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchallimageoffeed($username,$feedid);
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
	// public function Feedupvote($username, $feedid, $up, $down)
	// {
	// 	$feedService = new FeedService();
	// 	return $feedService->Feedupvote($username, $feedid, $up, $down);
	// }
	public function fetchAllFeed($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchAllFeed($username);
	}

	public function fetchAllFeedWithoutUser()
	{
		$feedService = new FeedService();
		return $feedService->fetchAllFeedWithoutUser();
	}	
	public function clearAllFeed($username)
	{
		$feedService = new FeedService();
		return $feedService->clearAllFeed($username);
	}
	public function clearFeedByLocation($username,$location)
	{
		$feedService = new FeedService();
		return $feedService->clearFeedByLocation($username,$location);
	}
	// public function Uploadfeed($username, $title, $description, $location)
	// {
	// 	$feedService = new FeedService();
	// 	return $feedService->Uploadfeed($username, $title, $description, $location);
	// }
	public function clearFeedByusername($username)
	{
		$feedService = new FeedService();
		return $feedService->clearFeedByusername($username);
	}
	public function Fetchallvideooffeed($username,$feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchallvideooffeed($username,$feedid);
	}
	public function Fetchfeedinfo($username,$feedid)
	{
		$feedService = new FeedService();
		return $feedService->Fetchfeedinfo($username,$feedid);
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
	public function fetchFeedByRole($username,$role)
	{
		$feedService = new FeedService();
		return $feedService->fetchFeedByRole($username,$role);
	}
	public function fetchFeedById($username,$feedid)
	{
		$feedService = new FeedService();
		return $feedService->fetchFeedById($username,$feedid);
	}
	public function fetchCollectionByuser($username)
	{
		$feedService = new FeedService();
		return $feedService->fetchCollectionByuser($username);
	}
	
}
