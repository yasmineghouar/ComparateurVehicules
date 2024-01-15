<?php
//on vient du href de l'image lien du vehicule dans le tableau de comparaison de CompareView
include __DIR__ . '/../Model/VehiculeModel.php';
include __DIR__ . '/../View/VehiculeView.php';
include __DIR__ . '/../Controller/AccueilController.php';
include __DIR__ . '/../Model/AccueilModel.php';
$vehiculeId = $_GET['id_vehicule_compare'];


$cf = new VehiculeModel();
$details = $cf->get_cars_details($vehiculeId); 
$v = new VehiculeView();
$v->showVehiculeDetails($vehiculeId);
?>