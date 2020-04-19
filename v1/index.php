<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require_once '../User/UserController.php';
require_once '../Register/RegisterController.php';
require_once '../Feed/FeedController.php';
require_once '../File/FileController.php';
require_once '../Mail/MailController.php';
require_once '../MessageBox/MessageBoxController.php';
require_once '../QueryBox/QueryBoxController.php';
require '../libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
/*
*/

//Register Controller



$app->post('/register/registerUser', function () use ($app) {
    verifyRequiredParams((array('username', 'firstname', 'email', 'password')));
    $first_name = $app->request->post('firstname');
    $last_name = $app->request->post('lastname');
    $username = $app->request->post('username');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $registerController = new RegisterController();
    $response = $registerController->registerUser($first_name, $last_name, $username, $email, $password);
    echoRespnse(200, $response);
});

$app->post('/register/checkUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $registerController = new RegisterController();
    $response = $registerController->checkUsername($username);
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



// User Controller
$app->post('/user/login',function() use($app){
    verifyRequiredParams((array('username','password')));
    $username = $app->request->post('username');
    $password = $app->request->post('password');
    $userController = new UserController();
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)){
        $response = $userController->loginUserWithUsername($username,$password);
    }
    else{
        $response = $userController->loginUserWithEmail($username,$password);
    }
    echoRespnse(200,$response);
});

$app->post('/user/fetchUserByUsername', function () use ($app) {
    verifyRequiredParams((array('username')));
    $username = $app->request->post('username');
    $userController = new UserController();
    $response = $userController->fetchUserByUsername($username);
    echoRespnse(200, $response);
});

$app->post('/user/clearUser', function () use ($app) {
    $userController = new UserController();
    $response = $userController->clearUser();
    echoRespnse(200, $response);
});
// feed controller








// feed by location 
$app->post('/feed/fetchFeedByLocation', function () use ($app) {
    verifyRequiredParams((array('location')));
    $location = $app->request->post('location');
    $feedController = new FeedController();
    $response = $feedController->Fetchfeedbylocation($location);
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
// upload image to feed
$app->post('/feed/uploadFeedImage', function () use ($app) {
    verifyRequiredParams((array('username', 'title', 'description', 'location', 'img')));
    $username = $app->request->post('username');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $img = $app->request->post('img');
    $feedController = new FeedController();
    $response = $feedController->Uploadfeedimage($username, $title, $description, $location, $img);
    echoRespnse(200, $response);
});

$app->post('/feed/uploadFeedVideo', function () use ($app) {
    verifyRequiredParams((array('username', 'title', 'description', 'location', 'video')));
    $username = $app->request->post('username');
    $title = $app->request->post('title');
    $description = $app->request->post('description');
    $location = $app->request->post('location');
    $video = $app->request->post('video');
    $feedController = new FeedController();
    $response = $feedController->Uploadfeedvideo($username, $title, $description, $location, $video);
    echoRespnse(200, $response);
});
$app->post('/feed/feedUpvote', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->Feedupvote($username, $feedid,1,0);
    echoRespnse(200, $response);
});
$app->post('/feed/feedDownvote', function () use ($app) {
    verifyRequiredParams((array('username', 'feed_id')));
    $username = $app->request->post('username');
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->Feedupvote($username, $feedid,0,1);
    echoRespnse(200, $response);
});


$app->post('/feed/fetchVotesOnPost', function () use ($app) {
    verifyRequiredParams((array('feed_id')));
    $feedid = $app->request->post('feed_id');

    $feedController = new FeedController();
    $response = $feedController->Fetchvotesonpost($feedid);
    echoRespnse(200, $response);
});

$app->post('/feed/fetchAllFeed', function () use ($app) {
    $feedController = new FeedController();
    $response = $feedController->fetchAllFeed();
    echoRespnse(200, $response);
});

$app->post('/feed/clearAllFeed', function () use ($app) {
    $feedController = new FeedController();
    $response = $feedController->clearAllFeed();
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
