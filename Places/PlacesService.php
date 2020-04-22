<?php

use Slim\Middleware\Flash;

class PlacesService
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/PlacesImp.php';
    }
    public function addNewPlace($username, $place_name,$place_state)
    {
        $PlacesImp = new PlacesImp();
        return $PlacesImp->addNewPlace($username, $place_name,$place_state);
    }
    public function fetchPlacesOfUser($username)
    {
        $PlacesImp = new PlacesImp();
        return $PlacesImp->fetchPlacesOfUser($username);
    }
}