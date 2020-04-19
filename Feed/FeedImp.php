<?php

class FeedImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FeedQuery.php';
    }


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
    public function Fetchvotesonpost($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchvotesonpost($feedid);
    }
    public function Uploadfeedimage($username,$title,$description,$location,$img)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Uploadfeedimage($username,$title,$description,$location,$img);
    }
    public function Uploadfeedvideo($username, $title, $description, $location, $video)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Uploadfeedvideo($username, $title, $description, $location, $video);
    }
    public function Feedupvote($username, $feedid,$up,$down)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Feedupvote($username, $feedid,$up,$down);
    }
    public function Fetchallimageoffeed($feedid)
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->Fetchallimageoffeed($feedid);
    }
    public function fetchAllFeed()
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->fetchAllFeed();
    }
    public function clearAllFeed()
    {
        $feedQuery = new FeedQuery();
        return $feedQuery->clearAllFeed();
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
}
