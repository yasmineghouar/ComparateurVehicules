<?php
include '../View/VehiculeView.php';
include '../Model/NewsModel.php';
include '../Model/VehiculeModel.php';
include '../Model/ComparateurModel.php';
include '../Model/AccueilModel.php';
include '../View/NewsView.php';
include '../View/ComparateurView.php';
// Vérifiez si la requête est une requête AJAX

$acceuilm = new AccueilModel();//remporter le menu ( probleme de chemin )
 $menuItms= $acceuilm->getMenu();

 /********************************************* */
if (isset($_POST['vehiculeId'])) {
$vehiculeId = $_POST['vehiculeId'];
//echo $marqueId;

echo"<script type='text/javascript'>location.href = '/Tidjelabine/';</script>";
}
/*******************COMPARAISON PLUS POPILAIRE QUAND JE CLIQUE J4AFFICHE LES DETAILS DE LA COMPARAISON****************** */
if (isset($_POST['id_vehicule_1'])) {//traiter la requete pr afficher les details de comparaison les plus populaires 

  $idVehicule1 = $_POST['id_vehicule_1'];
 
  $idVehicule2 = $_POST['id_vehicule_2'];

  $vehiculeModel = new VehiculeModel();//appeler les methode de vehicule Model pr recuperer les details des vehicules ensuite appeler 
  // appeler ensuite view pr les afficher
 $detailVehicule1=$vehiculeModel->get_cars_details($idVehicule1);
 $detailVehicule2=$vehiculeModel->get_cars_details($idVehicule2);
$comparateurview = new ComparateurView();
$comparateurview->show_header_comparaison();

$comparateurview->show_menu_comparaison($menuItms);
$comparateurview->showVehiculeDetailsMultiple2($detailVehicule1,$detailVehicule2);

}

/*Traitement requete GET apres clique sur Read More de lapage NEWS*/
if (isset($_GET['id'])) {

  
  $vc = new ComparateurView();//prc j'ai implementer les fonctions qui affichent le header avec le chemin different
  /** */
    $newsId = $_GET['id'];
    $newsmodel = new NewsModel();
    $newsdetails = $newsmodel->get_news_details($newsId);
   
    $v = new NewsView();
    
    $vc->show_header_comparaison();
    $vc->show_menu_comparaison($menuItms);
    $v->showNewsDetails($newsdetails);
   
       //echo $newsId;

       exit;
  }

  

if ($_SERVER["REQUEST_METHOD"] == "GET") {//traitementde la reqeuete get apres clique sur le bouton de comparaison(afficher le tableau de comparaison)
    
    $allFormData = $_SERVER['QUERY_STRING'];
   // echo "Résultats : " . $allFormData;//allFormData contient un string ou ya toutes les données des fromulaires envoyés


 // Initialisation des variables
$valeur1 = $valeur2 = $valeur3 = $valeur4 =$valeur5 = $valeur6 = $valeur7= $valeur8= $valeur9= $valeur10= $valeur11= $valeur12= $valeur13= $valeur14= $valeur15= $valeur16= "";

// Utilisation de la fonction parse_str pour extraire les valeurs
parse_str($allFormData, $valeurs);

// recuperation des valeurs remplies dans le formulaire
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
 

 $comparateurmodel = new ComparateurModel();//instancier model pour recuperer les details de vehicules (la marque,version,model,annee comme parametre)
 $car1details = $comparateurmodel->get_vehicule_details($valeur1,$valeur2,$valeur3,$valeur4);
 $car2details = $comparateurmodel->get_vehicule_details($valeur5,$valeur6,$valeur7,$valeur8);
 $car3details = $comparateurmodel->get_vehicule_details($valeur9,$valeur10,$valeur11,$valeur12);
 $car4details = $comparateurmodel->get_vehicule_details($valeur13,$valeur14,$valeur15,$valeur16);


 $markes=$acceuilm->get_marques();

 $comparateurview = new ComparateurView();//appeler lamethode de view pour afficher les details
 $comparateurview->show_header_comparaison();
 $comparateurview->show_menu_comparaison($menuItms);
 $comparateurview->show_Zone2($markes);

 switch (true) {
  case $car1details !== null && $car2details !== null && $car3details !== null && $car4details !== null:
      $comparateurview->showVehiculeDetailsMultiple4($car1details, $car2details, $car3details, $car4details);//4formlaires sont remplits
      break;

  case $car1details !== null && $car2details !== null && $car3details === null && $car4details === null://2formulaires sont remplit
      $comparateurview->showVehiculeDetailsMultiple2($car1details, $car2details);
      $comparateurmodel->insertComparaison($car1details, $car2details);
      break;
  case $car1details !== null && $car2details === null && $car3details === null && $car4details !== null://2formulaires sont remplit
        $comparateurview->showVehiculeDetailsMultiple2($car1details, $car4details);
        $comparateurmodel->insertComparaison($car1details, $car4details);
        break;
 case $car1details !== null && $car2details === null && $car3details !== null && $car4details === null://2formulaires sont remplit
          $comparateurview->showVehiculeDetailsMultiple2($car1details, $car3details);
          $comparateurmodel->insertComparaison($car1details, $car3details);
          break;
  case $car1details === null && $car2details !== null && $car3details !== null && $car4details === null://2formulaires sont remplit
            $comparateurview->showVehiculeDetailsMultiple2($car2details, $car3details);
            $comparateurmodel->insertComparaison($car2details, $car3details);
            break;
  case $car1details === null && $car2details !== null && $car3details === null && $car4details !== null://2formulaires sont remplit
              $comparateurview->showVehiculeDetailsMultiple2($car2details, $car4details);
              $comparateurmodel->insertComparaison($car2details, $car4details);
              break;
   case $car1details === null && $car2details === null && $car3details !== null && $car4details !== null://2formulaires sont remplit
                $comparateurview->showVehiculeDetailsMultiple2($car3details, $car4details);
                $comparateurmodel->insertComparaison($car3details, $car4details);
                break;
  case $car1details !== null && $car2details !== null && $car3details !== null && $car4details === null://3 formulaires sont remplit
      $comparateurview->showVehiculeDetailsMultiple3($car1details, $car2details, $car3details);
      break;
 case $car1details !== null && $car2details !== null && $car3details === null && $car4details !== null://3 formulaires sont remplit
        $comparateurview->showVehiculeDetailsMultiple3($car1details, $car2details, $car4details);
        break;
  case $car1details === null && $car2details !== null && $car3details !== null && $car4details !== null://3 formulaires sont remplit
      $comparateurview->showVehiculeDetailsMultiple3($car2details, $car3details, $car4details);
          break;
  case $car1details !== null && $car2details === null && $car3details !== null && $car4details !== null://3 formulaires sont remplit
            $comparateurview->showVehiculeDetailsMultiple3($car1details, $car3details, $car4details);
                break;
  default:
      echo "Vous devez remplir au moins 2 formulaires !";
      break;
}



 
 
 

 
} 
?>