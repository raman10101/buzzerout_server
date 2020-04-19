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
        $feedService = new FeedService();
        $response = $feedImp->Fetchfeedbylocation($location);
        if ($response["false"]) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $response["Feed"][$i]["detail"] = $feedService->Fetchfeedinfo($feedid);
            }
            return $response;
        } else {
            return $response;
        }
    }
    public function Fetchfeedbyusername($username)
    {
        $feedImp = new FeedImp();
        $feedService = new FeedService();
        $response = $feedImp->Fetchfeedbyusername($username);
        if ($response["error"] == false) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $response["Feed"][$i]["detail"] = $feedService->Fetchfeedinfo($feedid);
            }
            return $response;
        } else {
            return $response;
        }
    }
    public function Fetchvotesonfeed($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchvotesonfeed($feedid);
    }

    public function Uploadfeedimage($feed_id, $img)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedimage($feed_id, $img);
    }
    public function Uploadfeedvideo($feedid, $video)
    {
        $feedImp = new FeedImp();
        return $feedImp->Uploadfeedvideo($feedid, $video);
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
        $feedService = new FeedService();
        $response = $feedImp->fetchAllFeed();
        if ($response["error"] == false) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $response["Feed"][$i]["detail"] = $feedService->Fetchfeedinfo($feedid);
            }
        } 
        return $response;
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




    public function clearFeedByFeedId($feedid)
    {
        $feedImp = new FeedImp();
        $response = array();
        $response["feed delete"] = $feedImp->feedDelete($feedid);
        $response["feed image delete"] = $feedImp->imgdelete($feedid);
        $response["feed video delete"] = $feedImp->videoDelete($feedid);
        $response["feed vote delete"] = $feedImp->voteDelete($feedid);
        return $response;
    }




    public function clearFeedByLocation($location)
    {
        $feedImp = new FeedImp();
        $feedService = new FeedService();
        $response = array();
        $temp = $feedImp->Fetchfeedbylocation($location);
        if ($temp["error"] == false) {
            for ($i = 0; $i < count($temp["Feed"]); $i++) {
                # code...
                $feedid = $temp["Feed"][$i]["feed_id"];
                $response[$feedid] = array();
                $response[$feedid] = $feedService->clearFeedByFeedId($feedid);
            }
            return $response;
        } else {
            return $temp;
        }
    }
    public function clearFeedByusername($username)
    {
        $feedImp = new FeedImp();
        $feedService = new FeedService();
        $response = array();
        $temp = $feedImp->Fetchfeedbyusername($username);
        if ($temp["error"] == false) {
            for ($i = 0; $i < count($temp["Feed"]); $i++) {
                # code...
                $feedid = $temp["Feed"][$i]["feed_id"];
                $response[$feedid] = array();
                $response[$feedid] = $feedService->clearFeedByFeedId($feedid);
            }
            return $response;
        } else {
            return $temp;
        }
    }
    public function Fetchallvideooffeed($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchallvideooffeed($feedid);
    }
    public function Fetchfeedinfo($feedid)
    {
        $feedImp = new FeedImp();
        $response = array();
        $temp = $feedImp->Fetchallimageoffeed($feedid);
        if ($temp["error"] == false) {
            $response["images"] = $temp["image link"];
        }
        $temp = $feedImp->Fetchallvideooffeed($feedid);
        if ($temp["error"] == false) {
            $response["videos"] = $temp["video link"];
        }
        $temp = $feedImp->Fetchvotesonfeed($feedid);
        if ($temp["error"] == false) {
            $response["upvotes"] = $temp["upvote list"];
            $response["downvotes"] = $temp["downvote list"];
        }
        $response["info"] = "all info provided";
        return $response;
    }
}
