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
}
