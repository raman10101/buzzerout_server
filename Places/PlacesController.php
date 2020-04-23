<?php

class PlacesController
{

	function __construct()
	{
		require_once dirname(__FILE__) . '/PlacesService.php';
	}

	public function addNewPlace($username, $place_name,$place_state)
	{
		$PlacesService = new PlacesService();
		return $PlacesService->addNewPlace($username, $place_name,$place_state);
	}
	public function fetchPlacesOfUser($username)
	{
		$PlacesService = new PlacesService();
		return $PlacesService->fetchPlacesOfUser($username);
	}
	public function editPlace($username, $place_name,$place_state,$place_id){
		$PlacesService = new PlacesService();
		return $PlacesService->editPlace($username, $place_name,$place_state,$place_id);
	}
}
