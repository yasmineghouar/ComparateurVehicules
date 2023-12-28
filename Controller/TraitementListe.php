<?php
include '../View/VehiculeView.php';
include '../Model/NewsModel.php';
include '../Model/ComparateurModel.php';
include '../Model/AccueilModel.php';
include '../View/NewsView.php';
include '../View/ComparateurView.php';
// Vérifiez si la requête est une requête AJAX
if (isset($_POST['vehiculeId'])) {
$vehiculeId = $_POST['vehiculeId'];
//echo $marqueId;
echo $vehiculeId;
}
/*$vehiculeview = new VehiculeView();

$vehiculeview->showVehiculeDetails($vehiculeId);*/
if (isset($_GET['id'])) {
    $newsId = $_GET['id'];
    $newsmodel = new NewsModel();
    $newsdetails = $newsmodel->get_news_details($newsId);

    $v = new NewsView();
    $v->showNewsDetails($newsdetails);
   
       //echo $newsId;

       exit;
  }

  

if ($_SERVER["REQUEST_METHOD"] == "GET") {//traitementde la reqeuete get apres clique sur le bouton de comparaison(afficher le tableau de comparaison)
    // Récupérez les données de l'URL 
    $allFormData = $_SERVER['QUERY_STRING'];
   // echo "Résultats : " . $allFormData;//allFormData contient un string ou ya toutes les données des fromulaires envoyés


 // Initialisation des variables
$valeur1 = $valeur2 = $valeur3 = $valeur4 =$valeur5 = $valeur6 = $valeur7= $valeur8= $valeur9= $valeur10= $valeur11= $valeur12= $valeur13= $valeur14= $valeur15= $valeur16= "";

// Utilisation de la fonction parse_str pour extraire les valeurs
parse_str($allFormData, $valeurs);

// Affectation des valeurs aux variables
$valeur1 = isset($valeurs['marque1']) ? $valeurs['marque1'] : "";
$valeur2 = isset($valeurs['modele1']) ? $valeurs['modele1'] : "";
$valeur3 = isset($valeurs['version1']) ? $valeurs['version1'] : "";
$valeur4 = isset($valeurs['annee1']) ? $valeurs['annee1'] : "";

$valeur5 = isset($valeurs['marque2']) ? $valeurs['marque2'] : "";
$valeur6 = isset($valeurs['modele2']) ? $valeurs['modele2'] : "";
$valeur7 = isset($valeurs['version2']) ? $valeurs['version2'] : "";
$valeur8 = isset($valeurs['annee2']) ? $valeurs['annee2'] : "";

$valeur9 = isset($valeurs['marque3']) ? $valeurs['marque3'] : "";
$valeur10 = isset($valeurs['modele3']) ? $valeurs['modele3'] : "";
$valeur11 = isset($valeurs['version3']) ? $valeurs['version3'] : "";
$valeur12 = isset($valeurs['annee3']) ? $valeurs['annee3'] : "";

$valeur13 = isset($valeurs['marque4']) ? $valeurs['marque4'] : "";
$valeur14 = isset($valeurs['modele4']) ? $valeurs['modele4'] : "";
$valeur15 = isset($valeurs['version4']) ? $valeurs['version4'] : "";
$valeur16 = isset($valeurs['annee4']) ? $valeurs['annee4'] : "";
 
 /*echo "\nvaleur1".$valeur1;
 echo "\nvaleur2".$valeur2;
 echo "\nvaleur3".$valeur3;
 echo "\nvaleur4".$valeur4;
 echo "\nvaleur5".$valeur5;
 echo "\nvaleur6".$valeur6;
 echo "\nvaleur7".$valeur7;
 echo "\nvaleur8".$valeur8;
 echo "\nvaleur9".$valeur9;
 echo "\nvaleur10".$valeur10;
 echo "\nvaleur11".$valeur11;
 echo "\nvaleur12".$valeur12;
 echo "\nvaleur13".$valeur13;
 echo "valeur14".$valeur14;
 echo "valeur15".$valeur15;
 echo "valeur16".$valeur16;*/
 $comparateurmodel = new ComparateurModel();
 $car1details = $comparateurmodel->get_vehicule_details($valeur1,$valeur2,$valeur3,$valeur4);
 $car2details = $comparateurmodel->get_vehicule_details($valeur5,$valeur6,$valeur7,$valeur8);
 $car3details = $comparateurmodel->get_vehicule_details($valeur9,$valeur10,$valeur11,$valeur12);
 $car4details = $comparateurmodel->get_vehicule_details($valeur13,$valeur14,$valeur15,$valeur16);
 $acceuilm = new AccueilModel();//remporter le menu ( probleme de chemin )
 $menuItms= $acceuilm->getMenu();

 $markes=$acceuilm->get_marques();

 $comparateurview = new ComparateurView();
 $comparateurview->show_header_comparaison();
 $comparateurview->show_menu_comparaison($menuItms);
 $comparateurview->show_Zone2($markes);
 if ($car1details !== null && $car2details !== null && $car3details !== null && $car4details !== null) {//si 4 formulaires sont remplis
  $comparateurview->showVehiculeDetailsMultiple4($car1details,$car2details,$car3details,$car4details);

} elseif($car1details !== null && $car2details !== null && $car3details === null && $car4details === null){//2forms remplits
  $comparateurview->showVehiculeDetailsMultiple2($car1details,$car2details);
}elseif($car1details !== null && $car2details !== null && $car3details !== null && $car4details === null){//3 forms remplis
  $comparateurview->showVehiculeDetailsMultiple3($car1details,$car2details,$car3details);
}else{
  echo "vous devez remplir au moins 2 formulaires !";
}


 
 
 

 
} 
?>