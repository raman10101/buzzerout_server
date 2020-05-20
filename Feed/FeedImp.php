<?php

class FeedImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FeedQuery.php';
    }


    // New

    public function createBuzz($username, $title, $description, $location,$role){
        $feedQuery = new FeedQuery();
        return $feedQuery->createBuzz($username, $title, $description, $location, $role);
    }

    public function createBuzzAnonymously($username, $title, $description, $location, $role){
        $feedQuery = new FeedQuery();
        return $feedQuery->createBuzzAnonymously($username, $title, $description, $location, $role);
    }
    public function uploadImageToBuzz($feed_id, $img){
        $feedQuery = new FeedQuery();
        return $feedQuery->uploadImageToBuzz($feed_id, $img);
    }

    public function voteBuzz($username, $feedid, $up, $down)
	{
		$feedQuery = new FeedQuery();
        return $feedQuery->voteBuzz($username, $feedid, $up, $down);
	}
	
    public function shareBuzz($username, $feedid, $description){
		$feedQuery = new FeedQuery();
        return $feedQuery->shareBuzz($username, $feedid, $description);
	}
    public function hideBuzz($username, $buzzid){
		$feedQuery = new FeedQuery();
        return $feedQuery->hideBuzz($username, $buzzid);
	}
	public function saveBuzz($username, $buzzid){
		$feedQuery = new FeedQuery();
        return $feedQuery->saveBuzz($username, $buzzid);
    }
    public function followBuzz($username, $buzzid){
		$feedQuery = new FeedQuery();
        return $feedQuery->followBuzz($username, $buzzid);
    }
    public function unfollowBuzz($username, $buzzid){
		$feedQuery = new FeedQuery();
        return $feedQuery->unfollowBuzz($username, $buzzid);
	}







    // Old

    public function Fetchfeedbylocation($location)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchfeedbylocation($location);
    }
    public function Fetchfeedbyusername($username)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchfeedbyusername($username);
    }
    public function Fetchvotesonfeed($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchvotesonfeed($feedid);
    }
    public function Uploadfeedimage($feed_id, $img)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Uploadfeedimage($feed_id, $img);
    }
    public function Uploadfeedvideo($feedid, $video)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Uploadfeedvideo($feedid, $video);
    }
    public function Feedupvote($username, $feedid, $up, $down)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Feedupvote($username, $feedid, $up, $down);
    }
    public function Fetchallimageoffeed($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchallimageoffeed($feedid);
    }
    public function fetchAllFeed($username)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->fetchAllFeed($username);
    }
    public function clearAllFeed()
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->clearAllFeed();
    }
    public function Uploadfeed($username, $title, $description, $location, $role)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Uploadfeed($username, $title, $description, $location, $role);
    }
    public function   Fetchallvideooffeed($feedid)

    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchallvideooffeed($feedid);
    }




    // delete funcion 
    public function feedDelete($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->feedDelete($feedid);
    }
    public function imgdelete($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->imgdelete($feedid);
    }
    public function videoDelete($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->videoDelete($feedid);
    }
    public function voteDelete($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->voteDelete($feedid);
    }
    public function Fetchvotesonfeedbyuser($feedid, $username)

    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchvotesonfeedbyuser($feedid, $username);
    }
    public function editFeed($username, $feed_id, $title, $description, $location)

    {
        $feedQuery = new FeedQuery();
        return $feedQuery->editFeed($username, $feed_id, $title, $description, $location);
    }
    public function fetchFeedByRole($role)

    {
        $feedQuery = new FeedQuery();
        return $feedQuery->fetchFeedByRole($role);
    }
    public function fetchSaveBuzz($username){
		$feedQuery = new FeedQuery();
        return $feedQuery->fetchSaveBuzz($username);
    }
    public function fetchHideBuzz($username){
		$feedQuery = new FeedQuery();
        return $feedQuery->fetchHideBuzz($username);
    }
    public function fetchShareBuzz($username){
		$feedQuery = new FeedQuery();
        return $feedQuery->fetchShareBuzz($username);
    }
    public function fetchFeedById($feedid){
		$feedQuery = new FeedQuery();
        return $feedQuery->fetchFeedById($feedid);
    }
}
