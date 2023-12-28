<?php
// updateAnnee.php le fichier quii traite les requete coté serveur
include '../Model/AccueilModel.php';
// Vérifiez si la requête est une requête AJAX
$versionId = $_GET['version_data'];
//echo $marqueId;
$accueilmodel = new AccueilModel();
$annees = $accueilmodel->get_annee_by_version($versionId);
header('Content-Type: application/json');
echo json_encode($annees);//envoyer les modeles de la marque donnée sous format JSON

?>