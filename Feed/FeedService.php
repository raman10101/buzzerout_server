<?php

class FeedService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FeedImp.php';
        require_once  './../Comment/CommentController.php';
    }
    public function Fetchfeedbylocation($location)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController;
        $response = $feedImp->Fetchfeedbylocation($location);
        if ($response["false"]) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $response["Feed"][$i]["detail"] = $feedController->Fetchfeedinfo($feedid,"false");
            }
        }
        return $response;
    }
    public function Fetchfeedbyusername($username)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController;
        $response = $feedImp->Fetchfeedbyusername($username);
        if ($response["error"] == false) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $response["Feed"][$i]["detail"] = $feedController->Fetchfeedinfo($feedid,$username);
            }
        }
        return $response;
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
        $feedController = new FeedController;
        $response = $feedImp->fetchAllFeed();
        if ($response["error"] == false) {
            for ($i = 0; $i < count($response["Feed"]); $i++) {
                $feedid = $response["Feed"][$i]["feed_id"];
                $resp = $feedController->Fetchfeedinfo($feedid);
                $response["Feed"][$i]['comments'] = array();
                $response["Feed"][$i]['images'] = array();
                $response["Feed"][$i]['videos'] = array();
                $response["Feed"][$i]['upvotes'] = array();
                $response["Feed"][$i]['downvotes'] = array();
                $response["Feed"][$i]['comments']= $resp['comments'];
                $response["Feed"][$i]['images']= $resp['images'];
                $response["Feed"][$i]['videos']= $resp['videos'];
                $response["Feed"][$i]['upvotes']= $resp['upvotes'];
                $response["Feed"][$i]['downvotes']= $resp['downvotes'];
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
        $response = $feedImp->Uploadfeed($username, $title, $description, $location);
        return $response;
    }
    public function feedDelete($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->feedDelete($feedid);
    }
    public function imgdelete($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->imgdelete($feedid);
    }
    public function videoDelete($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->videoDelete($feedid);
    }
    public function voteDelete($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->voteDelete($feedid);
    }
    public function clearFeedByFeedId($feedid)
    {
        $feedController = new FeedController();
        $response = array();
        $response["feed_delete"] = $feedController->feedDelete($feedid);
        $response["feed_image_delete"] = $feedController->imgdelete($feedid);
        $response["feed_video_delete"] = $feedController->videoDelete($feedid);
        $response["feed_vote_delete"] = $feedController->voteDelete($feedid);

        $commentController = new CommentController();
        $response["feed_comment_delete"] = $commentController->deleteCommentByFeedId($feedid);
        return $response;
    }
    



    public function clearFeedByLocation($location)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response = array();
        $temp = $feedImp->Fetchfeedbylocation($location);
        if ($temp["error"] == false) {
            for ($i = 0; $i < count($temp["Feed"]); $i++) {
                # code...
                $feedid = $temp["Feed"][$i]["feed_id"];
                $response[$feedid] = array();
                $response[$feedid] = $feedController->clearFeedByFeedId($feedid,"false");
            }
        }
        return $response;
    }
    public function clearFeedByusername($username)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response = array();
        $temp = $feedImp->Fetchfeedbyusername($username);
        if ($temp["error"] == false) {
            for ($i = 0; $i < count($temp["Feed"]); $i++) {
                # code...
                $feedid = $temp["Feed"][$i]["feed_id"];
                $response[$feedid] = array();
                $response[$feedid] = $feedController->clearFeedByFeedId($feedid);
            }
        }
        return $response;
    }
    public function Fetchallvideooffeed($feedid)
    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchallvideooffeed($feedid);
    }
    public function Fetchfeedinfo($feedid)
    {
        $feedController = new FeedController();
        $response = array();
        $temp = $feedController->Fetchallimageoffeed($feedid);
        if ($temp["error"] == false) {
            $response["images"] = $temp["image_link"];
        }
        else{
            $response['images'] = array();
        }
        $temp = $feedController->Fetchallvideooffeed($feedid);
        if ($temp["error"] == false) {
            $response["videos"] = $temp["video_link"];
        }
        else{
            $response['videos'] = array();
        }
        $temp = $feedController->Fetchvotesonfeed($feedid);
        if ($temp["error"] == false) {
            $response["upvotes"] = $temp["upvote_list"];
            $response["downvotes"] = $temp["downvote_list"];
        }
        else{
            $response['upvotes'] = array();
            $response['downvotes'] = array();
        }
         
        $commentController = new CommentController();
        $temp = $commentController->fetchCommentByFeed($feedid);
        if ($temp["error"] == false) {
            $response["comments"] = $temp["comments"];
        }
        else{
            $response['comments'] = array();   
        }
        
        $response["info"] = "all info provided";
        return $response;
    }
    public function Fetchvotesonfeedbyuser($feedid,$username)

    {
        $feedImp = new FeedImp();
        return $feedImp->Fetchvotesonfeedbyuser($feedid,$username);
    }
}
