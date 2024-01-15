<?php
require_once ('template.php');

class MarquesView extends template{
 

    public function index(){

       $this->main();
        $this->showBigZone1();
        
      /* $accueilView = new AccueilView();
       $accueilView ->showZone1(); mais avec une taille plus grande pour les images*/

    }
    
    public function showBigZone1() {
       
        ?>
      
 
       <link rel="stylesheet" type="text/css" href="styles/marques.css">
       <script src="js/marques.js"></script>
         <!---UTILISER JAVASCRIPT POUR ENVOYER SOUS FORM DE POST L'ID de marque LORSQUE ON CLIQUE SUR SONN IMAGEE-->
          <!-- /Tidjelabine/ShowDetailsMarque appelle la methode showDetailsMarque du controller MarquesController qui appelle la methode view showDetails-->
        <form id="hiddenFormMrk"  action="/Tidjelabine/ShowDetailsMarque" method="post" style="display: none;">
        <input id="idMarqueClik" type="hidden" name="marqueIdClik"  >
        </form>

        <script>
         function submitFormMarques(idMarqueClique) {
           //modifier value de input pour envoyer en GET a la meme page pr aficher les details de marque cliquée
          $('#idMarqueClik').val(idMarqueClique);
          // recuperer le formulaire en haut par son id
          var form = document.getElementById('hiddenFormMrk');
           // Soumettre le formulaire
         form.submit();
           }
        </script>
          <!--fin script--->
       
     <?php
      
        $cf =  new MarquesController();
        $marques = $cf->BigZone1();//récupèrer les données du controleur(les marques principales)
    ?>
        <div id="Bzone1" class="Bzone1-container">
            <?php foreach ($marques as $marque): ?>
                <p class="marque-name"><?php echo $marque['nom_marque']; ?></p>
                <!--IMAGE LIEN MARQUE LORSQUE JE CLIQUE J4ENVOIS GET A LA MEME PAGE PR ACCEDER A SHOW DETAILS MARQUE EN BAS PAGE-->
                <a class="marques-scroll" data-id="<?php echo $marque['id_marque']; ?>"  data-marque="<?php echo $marque['nom_marque']; ?>" href="javascript:void(0);" onclick="submitFormMarques(<?php echo $marque['id_marque']; ?>)">
                    <img src="<?php echo $marque['image_marque']; ?>" alt="<?php echo $marque['nom_marque']; ?>">  
                                   
                </a>
               
            <?php endforeach; ?> 
            
            
        </div>
       
        <div id="marques-details-container" hidden> 
        <?php
        
/*
// Accéder à la valeur de l'ID marque 
if (isset($_GET['marqueId'])) {
    $marqueId = $_GET['marqueId']; //recuperer l'id marque cliqué a partir de la variable session
    unset($_GET['marqueId']);
   //afficher les details de la marque cliquée juste en haut
    $this->showBigZone2($marqueId);
       /* unset($_SESSION['marqueId']);
    session_destroy();*/
    



        ?>
        </div>
       
        
        <?php
    }


   /*fonction qui affiche les details d'une marque donnée par id */
    public function showBigZone2($marques_id) {//details marque
       
        ?>

       <link rel="stylesheet" type="text/css" href="styles/marques.css">
       <link rel="stylesheet" type="text/css" href="styles/vehicule.css">
       <script src="js/marques.js"></script>
       <?php
        $cf =  new MarquesController();
        $marques = $cf->BigZone1();//récupèrer les données du controleur(les marques principales)
        $noteAvrMrk= $cf->getMoyenneNotesMarque($marques_id);
        ?>
     <?php foreach ($marques as $marque): ?>
        
     <?php if ($marque['id_marque'] == $marques_id): ?>
        <div id="marque-<?php echo $marque['id_marque']; ?>" class="marque-details">
            <!--  les informations détaillées de la marque -->
            <h1> Détails de la marque: </h1>
            <p><span>Nom:</span> <?php echo $marque['nom_marque']; ?></p>
            <p><span>Année:</span> <?php echo $marque['annee_creation']; ?></p>
            <p><span>Pays d'origine:</span> <?php echo $marque['pays_origine']; ?></p>
            <p><span>Siège Social:</span> <?php echo $marque['siege_social']; ?></p>
            <a href="<?php echo $marque['lien_marque']; ?>">Lien vers le site web officiel de la marque . </a>
            <h2> Principales voitures de la marque: </h1>
            <!-- fin infos -->
               
      <?php 
      $cf =  new MarquesController();
      $cars = $cf->pcars_by_marque($marques_id);//récupèrer les données du controleur(les voitures principales qui appartiennet à la marque de l'id $marques_id)
      $resultats_avis = $cf->voir_tous_avis_marque($marques_id);//recuperer les avis de la marque
      ?>
      <div>
              <!---UTILISER JAVASCRIPT POUR ENVOYER SOUS FORM DE POST L'ID de VEHICULE LORSQUE ON CLIQUE SUR SONN IMAGEE-->

              <form id="hiddenForm3" action="/Tidjelabine/TraitementListe" method="post" style="display: none;">
              <input id="idVehiculeClique" type="hidden" name="vehiculeId"  >
               </form>
               <script>
    
               function submitFormm(idVehiculeClique) {
                //modifier value de input pour envoyer en POST au VEHICULECONTROLLER METHOD traitementformulaire(); pr aficher les details vehicule cliqué
               $('#idVehiculeClique').val(idVehiculeClique);
               // recuperer le formulaire en haut par son id
                var form = document.getElementById('hiddenForm3');
               // Soumettre le formulaire
               form.submit();
                }

        </script>

          <!--fin script--->
          <?php
         $counter = 0;

          foreach ($cars as $car):
         // Limiter la boucle to two iterations; pour afficher que les 2 principales voitures
         if ($counter < 2):
          ?>   
               <div onclick="submitFormm(<?php echo $car['id_vehicule']; ?>)" class="car-by-marque-container">
              <p ><span>Le modèle:</span><?php echo $car['modele']; ?></p>
            <a href="javascript:void(0);" onclick="submitForm(<?php echo $detail1['id_vehicule']; ?>)"><img src="<?php echo $car['image_vehicule']; ?>"></img></a>
          
        </div>
              <?php
             $counter++;
             endif;
             endforeach;
               ?>
          
     </div>
     <div class="show-Avis-container">
             <h2 style="color: #cf0015; font-size: 24px; text-align: center; margin-bottom: 20px; text-transform: uppercase;"> Note moyenne de la marque: </h2>
            <h2 style="color: #583E26; font-size: 24px; text-align: center; margin-bottom: 20px; text-transform: uppercase;">
                <?php echo number_format($noteAvrMrk, 1); ?> /5 
            </h2>
     </div>
      <!-- Le lien qui déclenchera l'affichage de la liste -->
<div id="aff-container">
<a id="afficherAvis">Lire les avis </a>
            </div>
<div id="tousAvis" class="show-Avis-container" style="display: none;">
     <ul>
        
         <?php foreach ($resultats_avis as $avis) : ?>
            <li>
               

                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) : ?>
            <!-- L'utilisateur est connecté, afficher le lien de like -->
            <a id="AvisLike"  href="javascript:void(0);" onclick="submitFormMarquesAvis(<?php echo $avis['id_avis']; ?> , <?php echo $_SESSION['user']; ?>)"> 
                <img src="images/favorie.png" width="20" height="20" style="margin-top: 5px;">
            </a>
        <?php endif; ?>
               <!---->
                <div class="avis-info">
                    <span id="avis-nom" style="font-weight: bold; color: #cf0015; margin-right: 10px; font-size: large;">
                        <?php echo $avis['prenom'] . ' ' . $avis['nom']; ?>:
                    </span>
                    <span id="avis-commentaire" style="color: #181c16; display: block; margin-bottom: 10px;">
                        <?php echo $avis['commentaire']; ?>
                    </span>
                    <span style="font-style: italic; color: #555; font-size: smaller;">
                       nombre de j'aime :
                    </span>
                    <span id="avis-nbr<?php echo $avis['id_avis']; ?>" style="font-style: italic; color: #555; font-size: smaller;">
                                         <?php echo $avis['nbr_apreciations']; ?> 
                    </span>
                    <span id="avis-date_avis" style="font-style: italic; color: #555; font-size: smaller;">
                        , publié le :<?php echo date('d-m-Y H:i:s', strtotime($avis['date_avis'])); ?>
                    </span>
                </div>
             </li>
        <?php endforeach; ?>
    </ul>
</div>
     <?php


/** **********PARTIE AJOUTER UN AVIS/NOTE MARQUE ************/

     if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { //il peut donner un avis qu'un user est connecté
    ?>
    
     </br></br>
    <div id="donnerNote" class="show-Donner-container">
<form action="/Tidjelabine/ShowDetailsMarque" method="post">
<!--soumission formulaires reinitialise ttes les variables php-->
<input type="hidden" name="marqueIdNote" value="<?php echo $marques_id; ?>"> 
    <select id="evaluation" name="noteMarque">
     <option value="1">1 étoile</option>
     <option value="2">2 étoiles</option>
      <option value="3">3 étoiles</option>
     <option value="4">4 étoiles</option>
     <option value="5">5 étoiles</option>
     </select>

<button type="submit">Donner une note</button>
</form>
    </div>
</br>

     <!--donner un avis pour une marque-->
     
     <div id="donnerAvis" class="show-Donner-container">
     <form action="/Tidjelabine/ShowDetailsMarque" method="post">
        <input type="hidden" name="marqueId" value="<?php echo $marques_id; ?>"> 
        <label for="avis" style="font-weight: bold; font-size: 25px;">Votre avis sur cette marque :</label>
        <textarea id="avis" name="avisMarque" rows="4" cols="50"></textarea>
        <button type="submit">Donner un avis</button>
     </form>
     
     </div>

     <?php
   
   
/*tariteement formulaire avis Marque */
        if (isset($_POST['avisMarque'])){
            $cntr= new MarquesController();
            // Récupérer la valeur de marqueId à partir du champ caché
            echo "avis marque inserer";
            $marque_id_post = $_POST['marqueId'];
            $commentaire=$_POST['avisMarque'];
            $id_utilisateur=$_SESSION["user"];
            
            $cntr->insertAvisMarque($id_utilisateur, $marque_id_post, $commentaire);//appeler la fct du controlleur qui insert l'avis ajouté
            }
             /**traitement formulaire note */
        if (isset($_POST['noteMarque'])){
            echo 'traitement note marque';
        $cntr= new MarquesController();
        // Récupérer la valeur de marqueId à partir du champ caché
        $marque_id_post = $_POST['marqueIdNote'];
        $note=$_POST['noteMarque'];
        $id_utilisateur=$_SESSION["user"];
        
        $cntr->insertNoteMarque($id_utilisateur,$marque_id_post,$note);
        }
    }
?>

     <!--Liste deroulante des voitures de la marque /Tidjelabine/TraitementListe envoit la requete vers VehiculeController methode traitement_liste()-->
     <form id="FormCar" action="/Tidjelabine/TraitementListe" method="post">
    <div>
        <label id="Choisir-voiture" for="carSelect" style="color: #cf0015; text-align: center; margin-bottom: 10px; font-weight: bold; font-style: italic; font-size: large;">Choisissez un véhicule :</label>
        <select name="vehiculeId" id="carSelect">
        <option value="">Véhicule</option>
            <?php foreach ($cars as $car): ?>
                
                <option value="<?php echo $car['id_vehicule']; ?>"><?php echo $car['modele'] . ' - ' . $car['version'] . ' (' . $car['annee'] . ')'; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Voir Details du Véhicule">
</form>
      <!-- fin de la boucle des marques--->  
     <?php endif; ?>
     <?php endforeach; ?>
            
        
        <?php
         
    }
  

}
?>
