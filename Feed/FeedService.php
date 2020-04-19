<?php

class FeedService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FeedImp.php';
    }
    public function Fetchfeedbylocation($location)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchfeedbylocation($location);
    }
    public function Fetchfeedbyusername($username)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchfeedbyusername($username);
    }
    public function Fetchvotesonpost($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchvotesonpost($feedid);
    }

    public function Uploadfeedimage($username, $title, $description, $location, $img)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedimage($username, $title, $description, $location, $img);
    }
    public function Uploadfeedvideo($username, $title, $description, $location, $video)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedvideo($username, $title, $description, $location, $video);
    }
    public function Feedupvote($username, $feedid, $up, $down)
    {
        $feedImp = new FeedImp();
        return $feedImp->Feedupvote($username, $feedid, $up, $down);
    }
    public function Fetchallimageoffeed($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchallimageoffeed($feedid);
    }
    public function fetchAllFeed()
    {
        $feedImp = new FeedImp();
        return $feedImp->fetchAllFeed();
    }
    public function clearAllFeed()
    {
        $feedImp = new FeedImp();
        return $feedImp->clearAllFeed();
    }
    public function clearFeedByLocation($location)
    {
        $feedImp = new FeedImp();
        $response=array();
        $temp=$feedImp->Fetchfeedbylocation($location);
        for ($i=0; $i < count($temp["Feed"]); $i++) { 
            # code...

        }
    }
}
