<?php

use Slim\Middleware\Flash;

class PlacesService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/PlacesImp.php';
        require_once dirname(__FILE__) . '/PlacesController.php';
        require_once  './../User/UserController.php';
        require_once '../Auth/AuthController.php';
    }
    public function addNewPlace($username, $place_name,$place_state)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $placesImp = new PlacesImp();
            $placeController = new PlacesController();
            $response = $placesImp->addNewPlace($username, $place_name,$place_state);
            if($response["error"] == false){
                $resp2 = $placeController->fetchPlacesOfUser($username);
                $response["places"] = $resp2["places"];
            }
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response;
    }
    public function fetchPlacesOfUser($username)
    {
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $PlacesImp = new PlacesImp();
            $response = $PlacesImp->fetchPlacesOfUser($username);
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }
    public function editPlace($username, $place_name,$place_state,$place_id){
        $response = array();
        //Check Username
        $authController = new AuthController();
        if ($authController->authenticateUsernameInUser($username)["error"] == false) {
            $placesImp = new PlacesImp();
            $placeController = new PlacesController();
            $response = $placesImp->editPlace($username, $place_name,$place_state,$place_id);
            if($response["error"] == false){
                $resp2 = $placeController->fetchPlacesOfUser($username);
                $response["places"] = $resp2["places"];
            }
        }
        else {
            $response["error"] = true;
            $response["message"] = "User Not Found";
          }
        return $response; 
    }
}