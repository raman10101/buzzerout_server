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
    public function Uploadfeedimage($username,$title,$description,$location,$img)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedimage($username,$title,$description,$location,$img);
    }
}
