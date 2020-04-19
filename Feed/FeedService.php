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

    public function Uploadfeedimage($feed_id, $img)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedimage($feed_id, $img);
    }
    public function Uploadfeedvideo( $feedid,$video)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedvideo( $feedid,$video);
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
    public function Uploadfeed($username, $title, $description, $location)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeed($username, $title, $description, $location);
    }
    



    public function clearFeedByFeedId($feedid){
        $feedImp = new FeedImp();
        $response=array();
        $response["feed delete"]=$feedImp->feedDelete($feedid);
        $response["feed image delete"]=$feedImp->imgdelete($feedid);
        $response["feed video delete"]=$feedImp->videoDelete($feedid);
        $response["feed vote delete"]=$feedImp->voteDelete($feedid);
        return $response;
    }




    public function clearFeedByLocation($location)
    {
        $feedImp = new FeedImp();
        $feedService= new FeedService();
        $response=array();
        $temp=$feedImp->Fetchfeedbylocation($location);
        if($temp["error"]==false){
        for ($i=0; $i < count($temp["Feed"]); $i++) { 
            # code...
            $feedid=$temp["Feed"][$i]["feed_id"];
            $response[$feedid]=array();
            $response[$feedid]=$feedService->clearFeedByFeedId($feedid);
        }
        return $response;}
        else{
            return $temp;
        }
    }
    public function clearFeedByusername($username)
    {
        $feedImp = new FeedImp();
        $feedService= new FeedService();
        $response=array();
        $temp=$feedImp->Fetchfeedbyusername($username);
        if($temp["error"]==false){
        for ($i=0; $i < count($temp["Feed"]); $i++) { 
            # code...
            $feedid=$temp["Feed"][$i]["feed_id"];
            $response[$feedid]=array();
            $response[$feedid]=$feedService->clearFeedByFeedId($feedid);
        }
        return $response;}
        else{
            return $temp;
        }
    }
}