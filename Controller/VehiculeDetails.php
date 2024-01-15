<?php
//on vient du href de l'image lien du vehicule dans le tableau de comparaison de CompareView
include 'VehiculeView.php';
$vehiculeId = $_GET['id_vehicule_compare'];
echo $vehiculeId ;
$v=new VehiculeView();
            $v->index();
            $v->showVehiculeDetails($vehiculeId);
?>