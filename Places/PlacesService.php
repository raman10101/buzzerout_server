<?php

use Slim\Middleware\Flash;

class PlacesService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/PlacesImp.php';
        require_once dirname(__FILE__) . '/PlacesController.php';
        require_once  './../User/UserController.php';
    }
    public function addNewPlace($username, $place_name,$place_state)
    {
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $placesImp = new PlacesImp();
        $placeController = new PlacesController();
        $resp = $placesImp->addNewPlace($username, $place_name,$place_state);
        if($resp["error"] == false){
            $resp2 = $placeController->fetchPlacesOfUser($username);
            $resp["places"] = $resp2["places"];
        }

        return $resp;
    }
    public function fetchPlacesOfUser($username)
    {
        $PlacesImp = new PlacesImp();
        return $PlacesImp->fetchPlacesOfUser($username);
    }
    public function editPlace($username, $place_name,$place_state,$place_id){
        //Check Username
        $user = new UserController();
        $userResponse = $user->fetchUserByUsername($username);
        if($userResponse["error"] == true){
            $userResponse["message"] = "Please SigIn first";
            return $userResponse;
        }
        $placesImp = new PlacesImp();
        $placeController = new PlacesController();
        $resp = $placesImp->editPlace($username, $place_name,$place_state,$place_id);
        if($resp["error"] == false){
            $resp2 = $placeController->fetchPlacesOfUser($username);
            $resp["places"] = $resp2["places"];
        }

        return $resp;
    }
}