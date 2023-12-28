<?php
// updateversion.php le fichier quii traite les requete coté serveur
include '../Model/AccueilModel.php';
// Vérifiez si la requête est une requête AJAX
$modeleId = $_GET['modele_data'];
//echo $marqueId;
$accueilmodel = new AccueilModel();
$versions = $accueilmodel->get_versions_by_modele($modeleId);
header('Content-Type: application/json');
echo json_encode($versions);//envoyer les modeles de la marque donnée sous format JSON

?>