<?php
 include '../Model/VehiculeModel.php';
 include '../Model/AvisModel.php';
 include '../View/ComparateurView.php';

session_start();

  //traitement requete apres un clique sur UNE MARQUE dans la page MARques----->PAGE DETAILS MARQUE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marqueId = $_POST['id'];
     // Stocker la valeur de l'ID_MARQUE dans la session, recuperer coté serveur a partir de la requete ajax, apres un clique sur une marque
     unset($_SESSION['marqueId']);
     $_SESSION['marqueId'] = $marqueId;
     
     
    
    
     
     echo $marqueId;
     
   
    
} 
if (isset($_GET['vehicFav']) && (isset($_GET['UserFav']))){ // traiter requete get vehicule FAVORISSSSSSS du user
  $vehicFav=$_GET['vehicFav'];
  $userFav=$_GET['UserFav'];
  unset($_GET['vehicFav']);
  unset($_GET['UserFav']);
  $vehModel = new VehiculeModel();
  $vehModel->ajouter_favoris($vehicFav, $userFav);
 
   header("location:/Tidjelabine/UserProfil");
}
if (isset($_GET['avisFav']) ){ // traiter requete apprecier un avis
  
  $avisFav=$_GET['avisFav'];
 
  $vehic=$_GET['vehic'];
  unset($_GET['avisFav']);
  $avisModel = new AvisModel();
  $avisModel->apprecierAvis($avisFav);
 
  header("location: /Tidjelabine/Marques");
 
  
}

if (isset($_GET['avisFavMrk']) ){ // traiter requete apprecier un avis d'une marque
  
  $avisFavMrk=$_GET['avisFavMrk'];
  
  
  unset($_GET['avisFavMrk']);
  $avisModel = new AvisModel();
  $avisModel->apprecierAvisMarque($avisFavMrk);
 
  header("location: /Tidjelabine/Marques");
 
  
}
if (isset($_GET['avisFavorie']) ){ // traiter requete apprecier un avis a partir de la page avis (le header est different)
  
  $avisFav=$_GET['avisFavorie'];

  unset($_GET['avisFavorie']);
  $avisModel = new AvisModel();
  $avisModel->apprecierAvis($avisFav);

  header("location: /Tidjelabine/Avis");
 
  
}
if (isset($_GET['offset']) ){ //traitement requete javascript pagination 5 avis a la fois
  //instanciation de la classe qui permet d'ajouter 5 avis prochains
 $cntr = new VehiculeModel();

// recupere rle get a partir de la requete ajax
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$vehiculeIdAvis = $_GET['vehiculeIdAvis'];
// afficher les 5 prochaines avis a partir de la fonction getAdditionalReviews
$newReviews = $cntr->getAdditionalReviews($vehiculeIdAvis, $offset, 5);
foreach ($newReviews as $avis) {
  ///retourner les 5 commentaires suivants
  echo '<li style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">';
  echo '<a href="/Tidjelabine/Controller/Clique_Marques.php?avisFav=' . $avis['id_avis'] . '">';
  echo '<img src="images/favorie.png" width="20" height="20" style="margin-top: 5px;">';
  echo '</a>';
  echo '<div class="avis-info">';
  echo '<span id="avis-nom" style="font-weight: bold; color: #cf0015; margin-right: 10px; font-size: large;">';
  echo $avis['prenom'] . ' ' . $avis['nom'] . ':';
  echo '</span>';
  echo '<span id="avis-commentaire" style="color: #181c16; display: block; margin-bottom: 10px;">';
  echo $avis['commentaire'];
  echo '</span>';
  echo '<span id="avis-nbr" style="font-style: italic; color: #555; font-size: smaller;">';
  echo 'nombre de j\'aime : ' . $avis['nbr_apreciations'];
  echo '</span>';
  echo '<span id="avis-date_avis" style="font-style: italic; color: #555; font-size: smaller;">';
  echo ', publié le : ' . date('d-m-Y H:i:s', strtotime($avis['date_avis']));
  echo '</span>';
  echo '</div>';
  echo '</li>';
}
}


?>