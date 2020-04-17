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
}
