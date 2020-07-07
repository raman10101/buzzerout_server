<?php

class FeedService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/FeedImp.php';
        require_once  './../Comment/CommentController.php';
        require_once  './../Profile/ProfileController.php';
        require_once  './../Feed/FeedController.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
        require_once '../Follow/FollowController.php';
    }
    // New

    // public function createBuzz($username, $title, $description, $location)
    // {
    //     $response = array();
    //     $authController = new AuthController();
    //     $userController = new UserController();
    //     $feedController = new FeedController();
    //     $feedImp = new FeedImp();
    //     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
    //         $userResponse = $userController->fetchUserByUsername($username);
    //         if ($userResponse["error"] == false) {
    //             $role = $userResponse["user"]["role"];
    //             $response = $feedImp->createBuzz($username, $title, $description, $location, $role);
    //             if ($response["error"] == false) {
    //                 $feedResponse = $feedController->Fetchfeedinfo($username,$response["buzzid"]);
    //                 $response['comments'] = array();
    //                 $response['images'] = array();
    //                 $response['videos'] = array();
    //                 $response['upvotes'] = array();
    //                 $response['downvotes'] = array();
    //                 $response['comments'] = $feedResponse['comments'];
    //                 $response['images'] = $feedResponse['images'];
    //                 $response['videos'] = $feedResponse['videos'];
    //                 $response['upvotes'] = $feedResponse['upvotes'];
    //                 $response['downvotes'] = $feedResponse['downvotes'];
    //             }
    //         }
    //     } else {
    //         $response["error"] = true;
    //         $response["message"] = "User Not Found";
    //     }
    //     return $response;
    // }
    public function createBuzz($username, $title, $description, $location)
    {
        $response = array();
        $authController = new AuthController();
        $userController = new UserController();
        $feedController = new FeedController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $userController->fetchUserByUsername($username);
            if ($userResponse["error"] == false) {
                $role = $userResponse["user"]["role"];
                $response = $feedImp->createBuzz($username, $title, $description, $location, $role);
                if ($response["error"] == false) {
                    $feedResponse = $feedController->fetchFeedById($username,$response["buzzid"]);
                    if($feedResponse['error'] == false){
                        $response['Feed'] = $feedResponse["Feed"];
                        unset($response['buzzid']);
                    }
                    else{
                        $response['error'] = true;
                        $response['message'] = "error in fetching the buzz created.";
                    }
                }
                else{
                    $response['error'] = true;
                    $response['message'] = "error in creating the buzz.";
                }
            }
            else{
                $response['error'] = true;
                $response['message'] = "error in fetching the user.";
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function createBuzzAnonymously($username, $title, $description, $location)
    {
        $response = array();
        $authController = new AuthController();
        $userController = new UserController();
        $feedController = new FeedController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $userController->fetchUserByUsername($username);
            if ($userResponse["error"] == false) {
                $role = $userResponse["user"]["role"];
                $response = $feedImp->createBuzz($username, $title, $description, $location, $role);
                if ($response["error"] == false) {
                    $feedResponse = $feedController->fetchFeedById($username,$response["buzzid"]);
                    if($feedResponse['error'] == false){
                        $response['Feed'] = $feedResponse["Feed"];
                        unset($response['buzzid']);
                    }
                    else{
                        $response['error'] = true;
                        $response['message'] = "error in fetching the buzz created.";
                    }
                }
                else{
                    $response['error'] = true;
                    $response['message'] = "error in creating the buzz.";
                }
            }
            else{
                $response['error'] = true;
                $response['message'] = "error in fetching the user.";
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function uploadImageToBuzz($feed_id, $img, $username)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();

        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->uploadImageToBuzz($feed_id, $img);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function upvoteBuzz($username, $feedid, $up, $down)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->voteBuzz($username, $feedid, $up, $down);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function downvoteBuzz($username, $feedid, $up, $down)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->voteBuzz($username, $feedid, $up, $down);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function removeUpvoteBuzz($username, $feedid, $up, $down)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->voteBuzz($username, $feedid, $up, $down);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function removeDownvoteBuzz($username, $feedid, $up, $down)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->voteBuzz($username, $feedid, $up, $down);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function shareBuzz($username, $feedid, $description)
    {

        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $response["shared_buzz"] = array();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->shareBuzz($username, $feedid, $description);
            $response["shared_buzz"] = $feedController->fetchShareBuzz($username)["shared_buzz"];
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function hideBuzz($username, $buzzid)
    {
        $response = array();
        $response["hide_buzz"] = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->hideBuzz($username, $buzzid);
            $response["hide_buzz"] = $feedController->fetchHideBuzz($username)["hide_buzz"];
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    
    public function unHideBuzz($username, $buzzid)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response["hide_buzz"] = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->unHideBuzz($username, $buzzid);
            $response["hide_buzz"] = $feedController->fetchHideBuzz($username)["hide_buzz"];

        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function saveBuzz($username, $buzzid)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response["save_buzz"] = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->saveBuzz($username, $buzzid);
            $response["save_buzz"] = $feedController->fetchSaveBuzz($username)["save_buzz"];

        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    
    public function unSaveBuzz($username, $buzzid)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $response["save_buzz"] = array();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->unSaveBuzz($username, $buzzid);
            $response["save_buzz"] = $feedController->fetchSaveBuzz($username)["save_buzz"];

        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function followBuzz($username, $buzzid)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->followBuzz($username, $buzzid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function unfollowBuzz($username, $buzzid)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->unfollowBuzz($username, $buzzid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }










    // Old

    public function Fetchfeedbylocation($username, $location)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController;
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $feedImp->Fetchfeedbylocation($location);
            if ($response["false"]) {
                for ($i = 0; $i < count($response["Feed"]); $i++) {
                    $feedid = $response["Feed"][$i]["feed_id"];
                    $response["Feed"][$i]["detail"] = $feedController->Fetchfeedinfo($feedid, "false");
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }


        return $response;
    }
    public function Fetchfeedbyusername($username)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController;
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $feedImp->Fetchfeedbyusername($username);
            if ($response["error"] == false) {
                for ($i = 0; $i < count($response["Feed"]); $i++) {
                    $feedid = $response["Feed"][$i]["feed_id"];
                    $response["Feed"][$i]["detail"] = $feedController->Fetchfeedinfo($feedid, $username);
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Fetchvotesonfeed($username, $feedid)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $feedImp->Fetchvotesonfeed($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Uploadfeedimage($feed_id, $img, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To upload a image";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->Uploadfeedimage($feed_id, $img);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Uploadfeedvideo($feedid, $video, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To upload a video";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->Uploadfeedvideo($feedid, $video);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Feedupvote($username, $feedid, $up, $down)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To upvote a Buzz";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->Feedupvote($username, $feedid, $up, $down);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Fetchallimageoffeed($username, $feedid)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $feedImp->Fetchallimageoffeed($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    // public function fetchAllFeed()
    // {
    //     $feedImp = new FeedImp();
    //     $feedController = new FeedController;
    //     $response = $feedImp->fetchAllFeed();

    //     if ($response["error"] == false) {
    //         for ($i = 0; $i < count($response["Feed"]); $i++) {

    //             $username = $response["Feed"][$i]["username"];
    //             $profileController = new ProfileController();
    //             $profileResponse = $profileController->fetchProfileOfUser($username);
    //             if ($profileResponse["error"] == false) {
    //                 $response["Feed"][$i]['userimage'] = $profileResponse["profile_detail"]["user_profile_image"];
    //             }
    //             $feedid = $response["Feed"][$i]["feed_id"];

    //             $resp = $feedController->Fetchfeedinfo($feedid);
    //             $response["Feed"][$i]['comments'] = array();
    //             $response["Feed"][$i]['images'] = array();
    //             $response["Feed"][$i]['videos'] = array();
    //             $response["Feed"][$i]['upvotes'] = array();
    //             $response["Feed"][$i]['downvotes'] = array();
    //             $response["Feed"][$i]['comments'] = $resp['comments'];
    //             $response["Feed"][$i]['images'] = $resp['images'];
    //             $response["Feed"][$i]['videos'] = $resp['videos'];
    //             $response["Feed"][$i]['upvotes'] = $resp['upvotes'];
    //             $response["Feed"][$i]['downvotes'] = $resp['downvotes'];
    //         }
    //     }
    //     return $response;
    // }
    public function fetchAllFeed($username)
    {
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController;
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $feedImp->fetchAllFeed($username);
            if ($response["error"] == false) {
                for ($i = 0; $i < count($response["Feed"]); $i++) {
                    $user = $response["Feed"][$i]["username"];
                    $profileController = new ProfileController();
                    $profileResponse = $profileController->fetchProfileOfUser($user);
                    if ($profileResponse["error"] == false) {
                        $response["Feed"][$i]['userimage'] = $profileResponse["profile"]["user_profile_image"];
                    }
                    $feedid = $response["Feed"][$i]["feed_id"];

                    $resp = $feedController->Fetchfeedinfo($username,$feedid);
                    $response["Feed"][$i]['comments'] = array();
                    $response["Feed"][$i]['images'] = array();
                    $response["Feed"][$i]['videos'] = array();
                    $response["Feed"][$i]['upvotes'] = array();
                    $response["Feed"][$i]['downvotes'] = array();
                    $response["Feed"][$i]['comments'] = $resp['comments'];
                    $response["Feed"][$i]['images'] = $resp['images'];
                    $response["Feed"][$i]['videos'] = $resp['videos'];
                    $response["Feed"][$i]['upvotes'] = $resp['upvotes'];
                    $response["Feed"][$i]['downvotes'] = $resp['downvotes'];

                    $followController = new FollowController();
                    $resp = $followController->fetchFollowing($username);
                    if ($resp['error'] == false) {
                        if (in_array($user, $resp['following'])) {
                            $response["Feed"][$i]['title'] = "Shared Buzz";
                        }
                    }
                }

            }
        } else {
            $response['error'] = true;
            $response['message'] = "user not found";
        }
        return $response;
    }

    public function fetchAllFeedWithoutUser()
    {
        $feedImp = new FeedImp();
        $response = $feedImp->fetchAllFeedWithoutUser();
        for ($i = 0; $i < count($response["Feed"]); $i++) {
            $user = $response["Feed"][$i]["username"];
            $profileController = new ProfileController();
            $feedController = new FeedController;
            $profileResponse = $profileController->fetchProfileOfUser($user);
            if ($profileResponse["error"] == false) {
                $response["Feed"][$i]['userimage'] = $profileResponse["profile"]["user_profile_image"];
            }
            $feedid = $response["Feed"][$i]["feed_id"];

            $resp = $feedController->Fetchfeedinfo($user,$feedid);
            $response["Feed"][$i]['comments'] = array();
            $response["Feed"][$i]['images'] = array();
            $response["Feed"][$i]['videos'] = array();
            $response["Feed"][$i]['upvotes'] = array();
            $response["Feed"][$i]['downvotes'] = array();
            $response["Feed"][$i]['comments'] = $resp['comments'];
            $response["Feed"][$i]['images'] = $resp['images'];
            $response["Feed"][$i]['videos'] = $resp['videos'];
            $response["Feed"][$i]['upvotes'] = $resp['upvotes'];
            $response["Feed"][$i]['downvotes'] = $resp['downvotes'];
        }
        return $response;
    }

    public function clearAllFeed($username)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $feedImp->clearAllFeed();
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function Uploadfeed($username, $title, $description, $location)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $user = new UserController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == false) {
                $role = $userResponse["user"]["role"];
                $response = $feedImp->Uploadfeed($username, $title, $description, $location, $role);
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }

        return $response;
    }

    public function feedDelete($feedid, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To delete a Buzz";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->feedDelete($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function imgdelete($feedid, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To delete a image of Buzz";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->imgdelete($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function videoDelete($feedid, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To delete a video of Buzz";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->videoDelete($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function voteDelete($feedid, $username)
    {
        //Check Username
        $user = new UserController();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $userResponse = $user->fetchUserByUsername($username);
            if ($userResponse["error"] == true) {
                $userResponse["message"] = "Please SigIn To delete a vote of Buzz";
                return $userResponse;
            }
            $feedImp = new FeedImp();
            return $feedImp->voteDelete($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }

    public function clearFeedByFeedId($feedid, $username)
    {
        $feedController = new FeedController();
        $authController = new AuthController();
        $commentController = new CommentController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = array();
            $feedDeleteResp = $feedController->feedDelete($feedid, $username);
            if($feedDeleteResp['error'] == false){
                $feedImgDeleteResp = $feedController->imgdelete($feedid, $username);
                if($feedImgDeleteResp['error'] == false){
                    $feedVideoDeleteResp = $feedController->videoDelete($feedid, $username);
                    if($feedVideoDeleteResp['error'] == false){
                        $feedVoteDeleteResp = $feedController->voteDelete($feedid, $username);
                        if($feedVoteDeleteResp['error'] == false){
                            $rfeedCommentDeleteResp= $commentController->deleteCommentByFeedId($username,$feedid);
                            if($rfeedCommentDeleteResp['error'] == false){
                                $response['error'] = false;
                                $response['message'] = "Feed deleted succesfully";
                            }
                            else{
                                $response['error'] = true;
                                $response['message'] = "Feed Comments not deleted ";
                            }
                        }
                        else{
                            $response['error'] = true;
                            $response['message'] = "Feed Votes not deleted ";
                        }
                    }
                    else{
                        $response['error'] = true;
                        $response['message'] = "Feed Videos not deleted ";
                    }
                }
                else{
                    $response['error'] = true;
                    $response['message'] = "Feed Images not deleted ";
                }
            }
            else{
                $response['error'] = true;
                $response['message'] = "Feed not deleted";
            }
            
            
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }

        return $response;
    }




    public function clearFeedByLocation($username,$location)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response = array();
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $temp = $feedImp->Fetchfeedbylocation($location);
            if ($temp["error"] == false) {
                for ($i = 0; $i < count($temp["Feed"]); $i++) {
                    # code...
                    $feedid = $temp["Feed"][$i]["feed_id"];
                    $response[$feedid] = array();
                    $response[$feedid] = $feedController->clearFeedByFeedId($feedid, "false");
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function clearFeedByusername($username)
    {
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        $response = array();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $temp = $feedImp->Fetchfeedbyusername($username);
            if ($temp["error"] == false) {
                for ($i = 0; $i < count($temp["Feed"]); $i++) {
                    # code...
                    $feedid = $temp["Feed"][$i]["feed_id"];
                    $response[$feedid] = array();
                    $response[$feedid] = $feedController->clearFeedByFeedId($feedid, $username);
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function Fetchallvideooffeed($username, $feedid)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $feedImp->Fetchallvideooffeed($feedid);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function Fetchfeedinfo($username,$feedid)
    {
        $feedController = new FeedController();
        $response = array();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $temp = $feedController->Fetchallimageoffeed($username,$feedid);
            if ($temp["error"] == false) {
                $response["images"] = $temp["image_link"];
            } else {
                $response['images'] = array();
            }
            $temp = $feedController->Fetchallvideooffeed($username,$feedid);
            if ($temp["error"] == false) {
                $response["videos"] = $temp["video_link"];
            } else {
                $response['videos'] = array();
            }
            $temp = $feedController->Fetchvotesonfeed($username,$feedid);
            if ($temp["error"] == false) {
                $response["upvotes"] = $temp["upvote_list"];
                $response["downvotes"] = $temp["downvote_list"];
            } else {
                $response['upvotes'] = array();
                $response['downvotes'] = array();
            }

            $commentController = new CommentController();
            $temp = $commentController->fetchCommentByFeed($username,$feedid);
            if ($temp["error"] == false) {
                $response["comments"] = $temp["comments"];
            } else {
                $response['comments'] = array();
            }

            $response["info"] = "all info provided";
        } 
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function Fetchvotesonfeedbyuser($feedid, $username)

    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            return $feedImp->Fetchvotesonfeedbyuser($feedid, $username);
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function editFeed($username, $feed_id, $title, $description, $location)

    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $feedController = new FeedController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $feedResp = $feedImp->editFeed($username, $feed_id, $title, $description, $location);
            if($feedResp['error'] == false){
                $feed = $feedController->fetchFeedById($username, $feed_id);
                if($feed['error'] == false){
                    $feedResp['Feed'] = $feed['Feed'];
                }
                else{
                    $feedResp['Feed'] = "Error in fetching feed";
                }
                return $feedResp;
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
            return $response;
        }
    }

    public function fetchFeedByRole($username, $role)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $feedController = new FeedController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $feeds = $feedImp->fetchFeedByRole($role)['feed'];
            $response['feeds'] = array();
            for ($i = 0; $i < count($feeds); $i++) {
                $feedid = $feeds[$i]["feed_id"];
                array_push($response["feeds"], $feedController->fetchFeedById($username,$feedid)["Feed"]);
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    // public function fetchFeedByRole($username, $role)
    // {
    //     $feedImp = new FeedImp();
    //     $authController = new AuthController();
    //     $response = array();
    //     if ($authController->authenticateUsernameInUser($username)["error"] == false) {
    //         return $feedImp->fetchFeedByRole($role);
    //     } else {
    //         $response["error"] = true;
    //         $response["message"] = "User Not Found";
    //     }
    //     return $response;
    // }
    public function fetchSaveBuzz($username)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->fetchSaveBuzz($username);
            if ($response['error'] === false) {
                for ($i = 0; $i < count($response["save_buzz"]); $i++) {
                    $feedid = $response["save_buzz"][$i]["buzz_id"];
                    $feedResp = $feedController->fetchFeedById($username,$feedid);
                    if($feedResp['error'] == false){
                        $response["save_buzz"][$i]= $feedResp['Feed'];
                    }
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function fetchHideBuzz($username)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->fetchHideBuzz($username);
            if ($response["error"] == false) {
                for ($i = 0; $i < count($response["hide_buzz"]); $i++) {
                    $feedid = $response["hide_buzz"][$i]["buzz_id"];
                    $feedResp = $feedController->fetchFeedById($username,$feedid);
                    if($feedResp['error'] == false){
                        $response["hide_buzz"][$i] =  $feedResp["Feed"];
                    }
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function fetchShareBuzz($username)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        $feedController = new FeedController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response =  $feedImp->fetchShareBuzz($username);
            if ($response["error"] == false) {
                for ($i = 0; $i < count($response["shared_buzz"]); $i++) {
                    $feedid = $response["shared_buzz"][$i]["feed_id"];
                    $feedResp = $feedController->fetchFeedById($username,$feedid);
                    if($feedResp['error'] == false){
                        $response["shared_buzz"][$i] =  $feedResp["Feed"];
                    }
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
        }
        return $response;
    }
    public function fetchFeedById($username,$feedid)
    {
        $feedImp = new FeedImp();
        $authController = new AuthController();
        $response = array();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $response = $feedImp->fetchFeedById($feedid);
            if ($response["error"] == false) {
                $feedController = new FeedController;
                $profileController = new ProfileController();
                $username = $response['Feed']['username'];
                $profileResponse = $profileController->fetchProfileOfUser($username);
                if ($profileResponse["error"] == false) {
                    $response["Feed"]['userimage'] = $profileResponse["profile"]["user_profile_image"];
                }
                $response["Feed"]['comments'] = array();
                $response["Feed"]['images'] = array();
                $response["Feed"]['videos'] = array();
                $response["Feed"]['upvotes'] = array();
                $response["Feed"]['downvotes'] = array();
                $resp = $feedController->Fetchfeedinfo($username,$feedid);
                if($resp['error'] = false){
                    $response["Feed"]['comments'] = $resp['comments'];
                    $response["Feed"]['images'] = $resp['images'];
                    $response["Feed"]['videos'] = $resp['videos'];
                    $response["Feed"]['upvotes'] = $resp['upvotes'];
                    $response["Feed"]['downvotes'] = $resp['downvotes'];
                }
            }
        } else {
            $response["error"] = true;
            $response["message"] = "Feeds Not Found";
        }
        return $response;
    }
    
    public function fetchCollectionByUser($username)
    {
        $response = array();
        $authController = new AuthController();
        $feedImp = new FeedImp();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $feedController = new FeedController();
            $response["hide_buzz"] = array();
            $response["shared_buzz"] = array();
            $response["save_buzz"] = array();
            $response["hide_buzz"] = $feedController->fetchHideBuzz($username)["hide_buzz"];
            $response["shared_buzz"] = $feedController->fetchShareBuzz($username)["shared_buzz"];
            $response["save_buzz"] = $feedController->fetchSaveBuzz($username)["save_buzz"];
            $response["error"] = false;
            $response["message"] = "Feeds Found";
        } else {
            $response["error"] = true;
            $response["message"] = "Feeds Not Found";
        }
        return $response;
    }
}
