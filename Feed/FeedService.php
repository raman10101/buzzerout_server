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
}
