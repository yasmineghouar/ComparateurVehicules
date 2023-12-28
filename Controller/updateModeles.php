<?php
// updateModeles.php le fichier quii traite les requete coté serveur
include '../Model/AccueilModel.php';
// Vérifiez si la requête est une requête AJAX
$marqueId = $_GET['marque_data'];
//echo $marqueId;
$accueilmodel = new AccueilModel();
$modeles = $accueilmodel->get_modeles_by_marque($marqueId);
header('Content-Type: application/json');
echo json_encode($modeles);//envoyer les modeles de la marque donnée sous format JSON

?>