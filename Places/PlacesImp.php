<?php

class PlacesImp
{

    function __construct()
    {
        require_once dirname(__FILE__) . '/PlacesQuery.php';
    }


    public function addNewPlace($username, $place_name,$place_state)
    {
        $PlacesQuery = new PlacesQuery();
        return $PlacesQuery->addNewPlace($username, $place_name,$place_state);
    }
    public function fetchPlacesOfUser($username)
    {
        $PlacesQuery = new PlacesQuery();
        return $PlacesQuery->fetchPlacesOfUser($username);
    }
    public function editPlace($username, $place_name,$place_state,$place_id){
        $PlacesQuery = new PlacesQuery();
        return $PlacesQuery->editPlace($username, $place_name,$place_state,$place_id);
    }

}
