<?php

use Slim\Middleware\Flash;

class PlacesService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/PlacesImp.php';
        require_once dirname(__FILE__) . '/PlacesController.php';
    }
    public function addNewPlace($username, $place_name,$place_state)
    {
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