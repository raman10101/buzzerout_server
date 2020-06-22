<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require_once '../User/UserController.php';
require_once '../Register/RegisterController.php';
require_once '../Feed/FeedController.php';
require_once '../Comment/CommentController.php';
require_once '../File/FileController.php';
require_once '../Mail/MailController.php';
require_once '../MessageBox/MessageBoxController.php';
require_once '../QueryBox/QueryBoxController.php';
require_once '../Follow/FollowController.php';
require_once '../Profile/ProfileController.php';
require_once '../UsersSocial/UsersSocialController.php';
require_once '../UsersCollege/UsersCollegeController.php';
require_once '../UsersWork/UsersWorkController.php';
require_once '../Details/UserdetailController.php';
require_once '../Places/PlacesController.php';
require_once '../NewUpdates/NewUpdatesController.php';
require_once '../Auth/AuthController.php';
require '../libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
/*
*/

/**
 * Auth Controller API starts here
 */

$app->post('/auth/authenticateNewUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $authController = new AuthController();
    $response = $authController->authenticateNewUsername($username);
    echoRespnse(200, $response);
});
$app->post('/auth/authenticateNewEmail', function () use ($app) {
    verifyRequiredParams((array('email')));
    $email = $app->request->post('email');
    $authController = new AuthController();
    $response = $authController->authenticateNewEmail($email);
    echoRespnse(200, $response);
});

/**
 * Auth Controller API ends here
 */



/**
 * Register Controller API starts here
 */
$app->post('/register/registerUser', function () use ($app) {
    verifyRequiredParams((array('username', 'firstname', 'email', 'password')));
    $first_name = $app->request->post('firstname');
    $last_name = $app->request->post('lastname');
    $username = $app->request->post('username');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $role = 0;
    if(isset($_POST["role"])){
        $role = $_POST["role"];
    }
    $registerController = new RegisterController();
    $response = $registerController->registerUser($first_name, $last_name, $username, $email, $password, $role);
    echoRespnse(200, $response);
});

$app->post('/register/activateRegisterUserLink', function () use ($app) {
    verifyRequiredParams((array('email')));
    $email = $app->request->post('email');
    $registerController = new RegisterController();
    $response = $registerController->activateRegisterUserLink($email);
    echoRespnse(200, $response);
});

$app->post('/register/allUsersToRegister', function () use ($app) {
    $registerController = new RegisterController();
    $response = $registerController->allUsersToRegister();
    echoRespnse(200, $response);
});

$app->post('/register/clearRegister', function () use ($app) {
    $registerController = new RegisterController();
    $response = $registerController->clearRegister();
    echoRespnse(200, $response);
});


/**
 * Register Controller API ends here
 */


/**
 * Test Api -2 // Fetch Username in register table
 */





// User Controller
$app->post('/user/login', function () use ($app) {
    verifyRequiredParams((array('username', 'password')));
    $username = $app->request->post('username');
    $password = $app->request->post('password');
    $userController = new UserController();
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $response = $userController->loginUserWithUsername($username, $password);
    } else {
        $response = $userController->loginUserWithEmail($username, $password);
    }
    echoRespnse(200, $response);
});

$app->post('/user/fetchUserByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->fetchUserByUsername($username);
    echoRespnse(200, $response);
});

$app->post('/user/fetchUserByEmail', function () use ($app) {
    verifyRequiredParams((array('email', 'username')));
    $email = $app->request->post('email');
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->fetchUserByEmail($username, $email);
    echoRespnse(200, $response);
});
$app->post('/user/updateFirstLastName', function () use ($app) {
    verifyRequiredParams((array('username','first_name','last_name')));
    $username = $app->request->post('username');
    $first_name = $app->request->post('first_name');
    $last_name = $app->request->post('last_name');
    $userController = new UserController();
    $response = $userController->updateFirstLastName($username,$first_name,$last_name);
    echoRespnse(200, $response);
});
$app->post('/user/fetchAllUsers', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->fetchAllUsers($username);
    echoRespnse(200, $response);
});

$app->post('/user/clearUser', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->clearUser($username);
    echoRespnse(200, $response);
});

$app->post('/user/resetPassword', function () use ($app) {
    verifyRequiredParams((array('username', 'old_password', 'new_password')));
    $username = $app->request->post('username');
    $old_password = $app->request->post('old_password');
    $new_password = $app->request->post('new_password');
    $userController = new UserController();
    $response = $userController->resetPassword($username, $old_password, $new_password);
    echoRespnse(200, $response);
});

$app->post('/user/forgotPassword', function () use ($app) {
    verifyRequiredParams((array('email', 'username')));
    $email = $app->request->post('email');
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->forgotPassword($username, $email);
    echoRespnse(200, $response);
});


// Buzz Related API

// Create Buzz
$app->post('/buzz/createBuzz',function() use($app){
    verifyRequiredParams((array('username', 'title', 'description', 'location')));
    $username = $app->request->post('username');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $feedController = new FeedController();
    $response = $feedController->createBuzz($username, $title, $description, $location);
    echoRespnse(200, $response);
});

// Create Buzz Anonymously
$app->post('/buzz/createBuzzAnonymously',function() use($app){
    verifyRequiredParams((array('username', 'title', 'description', 'location')));
    $username = $app->request->post('username');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $feedController = new FeedController();
    $response = $feedController->createBuzzAnonymously($username, $title, $description, $location);
    echoRespnse(200, $response);
});

// Upload Image To Buzz
$app->post('/buzz/uploadImageToBuzz', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'img', 'username')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $img = $app->request->post('img');
    $feedController = new FeedController();
    $response = $feedController->uploadImageToBuzz($feed_id, $img,$username);
    echoRespnse(200, $response);
});
$app->post('/buzz/upvoteBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->upvoteBuzz($username, $feedid, 1, 0);
    echoRespnse(200, $response);
});
$app->post('/buzz/downvoteBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->downvoteBuzz($username, $feedid, 0, 1);
    echoRespnse(200, $response);
});
$app->post('/buzz/removeUpvoteBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->removeUpvoteBuzz($username, $feedid, 0, 0);
    echoRespnse(200, $response);
});
$app->post('/buzz/removeDownvoteBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->removeDownvoteBuzz($username, $feedid, 0, 0);
    echoRespnse(200, $response);
});
$app->post('/buzz/shareBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');
    $description = "";
    if(isset($_POST["description"])){
        $description = $_POST["description"];
    }
    $feedController = new FeedController();
    $response = $feedController->shareBuzz($username, $feedid, $description);
    echoRespnse(200, $response);
});

$app->post('/buzz/hideBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->hideBuzz($username, $buzzid);
    echoRespnse(200, $response);
});
$app->post('/buzz/unHideBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->unHideBuzz($username, $buzzid);
    echoRespnse(200, $response);
});
$app->post('/buzz/saveBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->saveBuzz($username, $buzzid);
    echoRespnse(200, $response);
});
$app->post('/buzz/unSaveBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->unSaveBuzz($username, $buzzid);
    echoRespnse(200, $response);
});
$app->post('/buzz/followBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->followBuzz($username, $buzzid);
    echoRespnse(200, $response);
});
$app->post('/buzz/unfollowBuzz', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $buzzid = $app->request->post('feed_id');
    $feedController = new FeedController();
    $response = $feedController->unfollowBuzz($username, $buzzid);
    echoRespnse(200, $response);
});







// feed by location 
$app->post('/feed/fetchFeedByLocation', function () use ($app) {
    verifyRequiredParams((array('username','location')));
    $location = $app->request->post('location');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->Fetchfeedbylocation($username,$location);
    echoRespnse(200, $response);
});

// feed by user 
$app->post('/feed/fetchFeedByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->Fetchfeedbyusername($username);
    echoRespnse(200, $response);
});

$app->post('/feed/fetchFeedById', function () use ($app) {
    verifyRequiredParams((array('username','feed_id')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->fetchFeedById($username,$feed_id);
    echoRespnse(200, $response);
});


$app->post('/feed/fetchCollectionByuser', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->fetchCollectionByuser($username);
    echoRespnse(200, $response);
});

// TO DELETE
$app->post('/feed/uploadFeed', function () use ($app) {
    verifyRequiredParams((array('username', 'title', 'description', 'location')));
    $username = $app->request->post('username');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $feedController = new FeedController();
    $response = $feedController->Uploadfeed($username, $title, $description, $location);
    echoRespnse(200, $response);
});
// upload image to feed
$app->post('/feed/uploadFeedImage', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'img', 'username')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $img = $app->request->post('img');
    $feedController = new FeedController();
    $response = $feedController->Uploadfeedimage($feed_id, $img,$username);
    echoRespnse(200, $response);
});
// feed video upload 
$app->post('/feed/uploadFeedVideo', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'video', 'username')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');
    $video = $app->request->post('video');
    $feedController = new FeedController();
    $response = $feedController->Uploadfeedvideo($feedid, $video, $username);
    echoRespnse(200, $response);
});
$app->post('/feed/feedUpvote', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->Feedupvote($username, $feedid, 1, 0);
    echoRespnse(200, $response);
});
$app->post('/feed/feedDownvote', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->Feedupvote($username, $feedid, 0, 1);
    echoRespnse(200, $response);
});


$app->post('/feed/fetchVotesOnFeed', function () use ($app) {
    verifyRequiredParams((array('username','feed_id')));
    $feedid = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->Fetchvotesonfeed($username,$feedid);
    echoRespnse(200, $response);
});

$app->post('/feed/fetchAllFeed', function () use ($app) {
    $feedController = new FeedController();
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $response = $feedController->fetchAllFeed($username);
    echoRespnse(200, $response);
});

$app->post('/feed/fetchAllFeedWithoutUser', function () use ($app) {
    $feedController = new FeedController();
    $response = $feedController->fetchAllFeedWithoutUser();
    echoRespnse(200, $response);
});

$app->post('/feed/clearAllFeed', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->clearAllFeed($username);
    echoRespnse(200, $response);
});

$app->post('/feed/clearFeedByLocation', function () use ($app) {
    verifyRequiredParams((array('username','location')));
    $location = $app->request->post('location');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->clearFeedByLocation($username,$location);
    echoRespnse(200, $response);
});

$app->post('/feed/clearFeedByFeedId', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->clearFeedByFeedId($feed_id, $username);
    echoRespnse(200, $response);
});


$app->post('/feed/clearFeedByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->clearFeedByusername($username);
    echoRespnse(200, $response);
});


$app->post('/feed/fetchAllVideoOfFeed', function () use ($app) {
    verifyRequiredParams((array('username','feed_id')));
    $feedid = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->Fetchallvideooffeed($username,$feedid);
    echoRespnse(200, $response);
});


$app->post('/feed/fetchAllImageOfFeed', function () use ($app) {
    verifyRequiredParams((array('username','feed_id')));
    $feedid = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $feedController = new FeedController();
    $response = $feedController->Fetchallimageoffeed($username,$feedid);
    echoRespnse(200, $response);
});

$app->post('/feed/editFeed', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'username', 'title', 'description', 'location')));
    $username = $app->request->post('username');
    $feed_id = $app->request->post('feed_id');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $feedController = new FeedController();
    $response = $feedController->editFeed($username, $feed_id, $title, $description, $location);
    echoRespnse(200, $response);
});



//follow controller
$app->post('/follow/newFollow', function () use ($app) {
    verifyRequiredParams((array('followed_by',  'followes_to')));
    $by = $app->request->post('followed_by');
    $to = $app->request->post('followes_to');
    $followController = new FollowController();
    $response = $followController->newFollow($by, $to);
    echoRespnse(200, $response);
});
$app->post('/follow/fetchFollowing', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $followController = new FollowController();
    $response = $followController->fetchFollowing($username);
    echoRespnse(200, $response);
});
$app->post('/follow/fetchFollowedBy', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $followController = new FollowController();
    $response = $followController->fetchFollowedBy($username);
    echoRespnse(200, $response);
});
$app->post('/follow/fetchAllFollow', function () use ($app) {
    $followController = new FollowController();
    $response = $followController->fetchAllFollow();
    echoRespnse(200, $response);
});
$app->post('/follow/deleteFollowing', function () use ($app) {
    verifyRequiredParams((array('username', 'user_to_deleted')));
    $username = $app->request->post('username');
    $to = $app->request->post('user_to_deleted');
    $followController = new FollowController();
    $response = $followController->deleteFollowing($username, $to);
    echoRespnse(200, $response);
});
$app->post('/follow/deleteFollower', function () use ($app) {
    verifyRequiredParams((array('username', 'follower_username')));
    $username = $app->request->post('username');
    $by = $app->request->post('follower_username');
    $followController = new FollowController();
    $response = $followController->deleteFollower($username, $by);
    echoRespnse(200, $response);
});
$app->post('/follow/deleteUserConnections', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $followController = new FollowController();
    $response = $followController->deleteUserConnections($username);
    echoRespnse(200, $response);
});
$app->post('/follow/deleteAllFollow', function () use ($app) {
    $followController = new FollowController();
    $response = $followController->deleteAllFollow();
    echoRespnse(200, $response);
});



// Comments Controller

$app->post('/comment/addComment', function () use ($app) {
    verifyRequiredParams((array('feed_id',  'username', 'text')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $text = $app->request->post('text');
    $commentController = new CommentController();
    $response = $commentController->addComment($feed_id,  $username, $text);
    echoRespnse(200, $response);
});

$app->post('/comment/editComment', function () use ($app) {
    verifyRequiredParams((array('comment_id', 'username', 'text')));
    $username = $app->request->post('username');
    $comment_id = $app->request->post('comment_id');
    $text = $app->request->post('text');
    $commentController = new CommentController();
    $response = $commentController->editComment($comment_id,  $username, $text);
    echoRespnse(200, $response);
});

$app->post('/comment/fetchCommentByFeed', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'username')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $commentController = new CommentController();
    $response = $commentController->fetchCommentByFeed($username, $feed_id);
    echoRespnse(200, $response);
});

$app->post('/comment/fetchCommentByCommentId', function () use ($app) {
    verifyRequiredParams((array('comment_id', 'username')));
    $comment_id = $app->request->post('comment_id');
    $username = $app->request->post('username');
    $commentController = new CommentController();
    $response = $commentController->fetchCommentByCommentId($comment_id, $username);
    echoRespnse(200, $response);
});

$app->post('/comment/fetchAllComments', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $commentController = new CommentController();
    $response = $commentController->fetchAllComments($username);
    echoRespnse(200, $response);
});

$app->post('/comment/deleteCommentById', function () use ($app) {
    verifyRequiredParams((array('id', 'username')));
    $username = $app->request->post('username');
    $id = $app->request->post('id');
    $commentController = new CommentController();
    $response = $commentController->deleteCommentById($id, $username);
    echoRespnse(200, $response);
});

$app->post('/comment/deleteCommentByFeedId', function () use ($app) {
    verifyRequiredParams((array('feed_id', 'username')));
    $feed_id = $app->request->post('feed_id');
    $username = $app->request->post('username');
    $commentController = new CommentController();
    $response = $commentController->deleteCommentByFeedId($username, $feed_id);
    echoRespnse(200, $response);
});

$app->post('/comment/clearComment', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $commentController = new CommentController();
    $response = $commentController->clearComment($username);
    echoRespnse(200, $response);
});









// profile controller
$app->post('/profile/updateProfile', function () use ($app) {
    verifyRequiredParams((array('username','firstname')));
    $username = $app->request->post('username');
    $firstname = $app->request->post('firstname');
    
    $lastname = "";
    if(isset($_POST["lastname"])){
        $lastname = $_POST["lastname"];
    }
    $city = "";
    if(isset($_POST["city"])){
        $city = $_POST["city"];
    }
    $state = "";
    if(isset($_POST["state"])){
        $state = $_POST["state"];
    }
    $country = "";
    if(isset($_POST["country"])){
        $country = $_POST["country"];
    }
    $gender = "";
    if(isset($_POST["gender"])){
        $gender = $_POST["gender"];
    }
    $dob = "";
    if(isset($_POST["dob"])){
        $dob = $_POST["dob"];
    }
    $marital = "";
    if(isset($_POST["marital"])){
        $marital = $_POST["marital"];
    }
    $profileController = new ProfileController();
    $response = $profileController->updateProfile($username, $firstname, $lastname, $city, $state, $country, $gender, $dob, $marital);
    echoRespnse(200, $response);
});
$app->post('/profile/createProfile', function () use ($app) {
    verifyRequiredParams((array('username','address','mobile','gender','profile_image','timeline_image','dob')));
    $username = $app->request->post('username');
    $user_address = $app->request->post('address');
    $user_mobile = $app->request->post('mobile');
    $user_gender = $app->request->post('gender');
    $user_profile_image = $app->request->post('profile_image');
    $user_timeline_image = $app->request->post('timeline_image');
    $user_dob = $app->request->post('dob');
    $profileController = new ProfileController();
    $response = $profileController->createProfileOfUser($username, $user_address, $user_mobile, $user_gender, $user_dob, $user_profile_image, $user_timeline_image);
    echoRespnse(200, $response);
});
$app->post('/profile/fetchProfileOfUser', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $profileController = new ProfileController();
    $response = $profileController->fetchProfileOfUser($username);
    echoRespnse(200, $response);
});
$app->post('/profile/fetchProfileOfAllUsers', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $profileController = new ProfileController();
    $response = $profileController->fetchProfileOfAllUsers($username);
    echoRespnse(200, $response);
});

$app->post('/profile/updateMobileAddress', function () use ($app) {
    verifyRequiredParams((array('username','mobile','address')));
    $username = $app->request->post('username');
    $mobile = $app->request->post('mobile');
    $address = $app->request->post('address');
    $profileController = new ProfileController();
    $response = $profileController->updateMobileAddress($username, $mobile, $address);
    echoRespnse(200, $response);
});
$app->post('/profile/updateDobGender', function () use ($app) {
    verifyRequiredParams((array('username','dob','uob','gender')));
    $username = $app->request->post('username');
    $dob = $app->request->post('dob');
    $gender = $app->request->post('gender');
    $uob = $app->request->post('uob');
    $profileController = new ProfileController();
    $response = $profileController->updateDobGender($username, $dob, $uob,$gender);
    echoRespnse(200, $response);
});

$app->post('/profile/updateUserProfileImage', function () use ($app) {
    verifyRequiredParams((array('username','img')));
    $username = $app->request->post('username');
    $img = $app->request->post('img');
    $profileController = new ProfileController();
    $response = $profileController->updateUserProfileImage($username, $img);
    echoRespnse(200, $response);
});

$app->post('/profile/updateUserTimelineImage', function () use ($app) {
    verifyRequiredParams((array('username','img')));
    $username = $app->request->post('username');
    $img = $app->request->post('img');
    $profileController = new ProfileController();
    $response = $profileController->updateUserTimelineImage($username, $img);
    echoRespnse(200, $response);
});

$app->post('/profile/updateUserWebsiteLink', function () use ($app) {
    verifyRequiredParams((array('username','phone_no', 'social_link', 'website_url')));
    $username = $app->request->post('username');
    $phone_no = $app->request->post('phone_no');
    $social_link = $app->request->post('social_link');
    $website_url = $app->request->post('website_url');
    $profileController = new ProfileController();
    $response = $profileController->updateUserWebsiteLink($username, $phone_no, $social_link, $website_url);
    echoRespnse(200, $response);
});

//detial conrtoller

$app->post('/detail/updateUserDetails', function () use ($app) {
    verifyRequiredParams((array('username','about_you','other_name','fav_quote')));
    $username = $app->request->post('username');
    $about_you = $app->request->post('about_you');
    $other_name = $app->request->post('other_name');
    $fav_quote = $app->request->post('fav_quote');
    $detailController = new UserdetailController();
    $response = $detailController->updateUserDetails($username, $about_you, $other_name, $fav_quote);
    echoRespnse(200, $response);
});
$app->post('/detail/fetchUserDetail', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $detailController = new UserdetailController();
    $response = $detailController->fetchUserDetail($username);
    echoRespnse(200, $response);
});
$app->post('/detail/', function () use ($app) {
    verifyRefetchUserDetailOfAllUsersquiredParams((array('username')));
    $username = $app->request->post('username');
    $detailController = new UserdetailController();
    $response = $detailController->fetchUserDetailOfAllUsers($username);
    echoRespnse(200, $response);
});

// places detail

// UsersWork Controller


$app->post('/usersWork/addWork', function () use ($app) {
    verifyRequiredParams((array('username',  'work_place', 'work_profile')));
    $username = $app->request->post('username');
    $work_place = $app->request->post('work_place');
    $work_profile = $app->request->post('work_profile');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->addWork($username,  $work_place, $work_profile);
    echoRespnse(200, $response);
});

$app->post('/usersWork/editWork', function () use ($app) {
    verifyRequiredParams((array('username',  'work_place', 'work_profile','work_id')));
    $username = $app->request->post('username');
    $work_place = $app->request->post('work_place');
    $work_profile = $app->request->post('work_profile');
    $work_id = $app->request->post('work_id');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->editWork($username,  $work_place, $work_profile,$work_id);
    echoRespnse(200, $response);
});

$app->post('/usersWork/fetchWorkByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->fetchWorkByUsername($username);
    echoRespnse(200, $response);
});
$app->post('/usersWork/fetchWorkOfAllUsers', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->fetchWorkOfAllUsers($username);
    echoRespnse(200, $response);
});

$app->post('/usersWork/deleteWorkDetailsById', function () use ($app) {
    verifyRequiredParams((array('id', 'username')));
    $username = $app->request->post('username');
    $id = $app->request->post('id');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->deleteWorkDetailsById($id, $username);
    echoRespnse(200, $response);
});

$app->post('/usersWork/clearUsersWork', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $usersworkController = new UsersWorkController();
    $response = $usersworkController->clearUsersWork($username);
    echoRespnse(200, $response);
});


// UsersCollege Controller


$app->post('/usersCollege/addCollege', function () use ($app) {
    verifyRequiredParams((array('username',  'college_name', 'college_place')));
    $username = $app->request->post('username');
    $college_name = $app->request->post('college_name');
    $college_place = $app->request->post('college_place');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->addCollege($username,  $college_name, $college_place);
    echoRespnse(200, $response);
});
$app->post('/usersCollege/editCollege', function () use ($app) {
    verifyRequiredParams((array('username',  'college_name', 'college_place','college_id')));
    $username = $app->request->post('username');
    $college_name = $app->request->post('college_name');
    $college_place = $app->request->post('college_place');
    $college_id = $app->request->post('college_id');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->editCollege($username,  $college_name, $college_place,$college_id);
    echoRespnse(200, $response);
});


$app->post('/usersCollege/fetchCollegeByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->fetchCollegeByUsername($username);
    echoRespnse(200, $response);
});

$app->post('/usersCollege/fetchCollegeById', function () use ($app) {
    verifyRequiredParams((array('username', 'id')));
    $username = $app->request->post('username');
    $college_id = $app->request->post('id');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->fetchCollegeById($username, $college_id);
    echoRespnse(200, $response);
});

$app->post('/usersCollege/fetchCollegeOfAllUsers', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->fetchCollegeOfAllUsers($username);
    echoRespnse(200, $response);
});

$app->post('/usersCollege/deleteCollegeDetailsById', function () use ($app) {
    verifyRequiredParams((array('id', 'username')));
    $username = $app->request->post('username');
    $id = $app->request->post('id');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->deleteCollegeDetailsById($id, $username);
    echoRespnse(200, $response);
});


$app->post('/usersCollege/clearUsersCollege', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userscollegeController = new UsersCollegeController();
    $response = $userscollegeController->clearUsersCollege($username);
    echoRespnse(200, $response);
});




// UsersSocial Controller


$app->post('/usersSocial/addSocialAccountDetails', function () use ($app) {
    verifyRequiredParams((array('username',  'user_facebook', 'user_twitter', 'user_google_plus', 'user_instagram', 'user_youtube')));
    $username = $app->request->post('username');
    $user_facebook = $app->request->post('user_facebook');
    $user_twitter = $app->request->post('user_twitter');
    $user_google_plus = $app->request->post('user_google_plus');
    $user_instagram = $app->request->post('user_instagram');
    $user_youtube = $app->request->post('user_youtube');
    $userssocialController = new UsersSocialController();
    $response = $userssocialController->addSocialAccountDetails($username,  $user_facebook, $user_twitter, $user_google_plus, $user_instagram, $user_youtube);
    echoRespnse(200, $response);
});
$app->post('/usersSocial/fetchSocialDetailsByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userssocialController = new UsersSocialController();
    $response = $userssocialController->fetchSocialDetailsByUsername($username);
    echoRespnse(200, $response);
});

$app->post('/usersSocial/fetchSocialDetailsOfAllUsers', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userssocialController = new UsersSocialController();
    $response = $userssocialController->fetchSocialDetailsOfAllUsers($username);
    echoRespnse(200, $response);
});
$app->post('/usersSocial/deleteSocialDetailsById', function () use ($app) {
    verifyRequiredParams((array('id', 'username')));
    $username = $app->request->post('username');
    $id = $app->request->post('id');
    $userssocialController = new UsersSocialController();
    $response = $userssocialController->deleteSocialDetailsById($id, $username);
    echoRespnse(200, $response);
});

$app->post('/usersSocial/clearUsersSocial', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userssocialController = new UsersSocialController();
    $response = $userssocialController->clearUsersSocial($username);
    echoRespnse(200, $response);
});

// User Places

$app->post('/places/addPlace', function () use ($app) {
    verifyRequiredParams((array('username','place_name','place_state')));
    $username = $app->request->post('username');
    $place_name = $app->request->post('place_name');
    $place_state = $app->request->post('place_state');
    $placeController = new PlacesController();
    $response = $placeController->addNewPlace($username, $place_name,$place_state);
    echoRespnse(200, $response);
});
$app->post('/places/editPlace', function () use ($app) {
    verifyRequiredParams((array('username','place_name','place_state','place_id')));
    $username = $app->request->post('username');
    $place_name = $app->request->post('place_name');
    $place_state = $app->request->post('place_state');
    $place_id = $app->request->post('place_id');
    $placeController = new PlacesController();
    $response = $placeController->editPlace($username, $place_name,$place_state,$place_id);
    echoRespnse(200, $response);
});
$app->post('/places/fetchPlacesOfUser', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $placeController = new PlacesController();
    $response = $placeController->fetchPlacesOfUser($username);
    echoRespnse(200, $response);
});

/**
 * New Updates
 */
$app->post('/updates/fetchAllUpdates',function() use($app){
    $newUpdatesController = new NewUpdatesController();
    $response = $newUpdatesController->fetchAllUpdates();
    echoRespnse(200, $response);
});









/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields)
{
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email)
{
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response)
{
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
