<?php
require_once ('template.php');

class AvisView extends template{


    public function index(){

        $this->main();
       $this->show_marques();
       $this->show_footer();
       
        

     }

     
     public function show_marques(){

    ?>
      
 
       <link rel="stylesheet" type="text/css" href="styles/marques.css">
       <script src="js/marques.js"></script>
       <!---UTILISER JAVASCRIPT POUR ENVOYER SOUS FORM DE POST L'ID de marque LORSQUE ON CLIQUE SUR SONN IMAGEE-->
          <!-- /Tidjelabine/ShowDetailsMarque appelle la methode showDetailsMarque du controller MarquesController qui appelle la methode view showDetails-->
          <form id="hiddenFormMrk"  action="/Tidjelabine/ShowDetailsMarqueAvis" method="post" style="display: none;">
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
       
        <div id="marques-details-container"> 
        <?php
        

// Accéder à la valeur de l'ID depuis la session
/*if (isset($_SESSION['marqueId'])) {
    $marqueId = $_SESSION['marqueId'];
    unset($_SESSION['marqueId']);
    //echo 'La valeur de l\'ID de la marqueeeeeeeeeeeeeeee est : ' . $marqueId;
    $this->show_marques_details($marqueId);
   
       /* unset($_SESSION['marqueId']);
    session_destroy();*/
    
//} 

        ?>
        </div>
       
        
        <?php
       
        

     }

     /*fonction qui affiche les details d'une marque donnée par id */
    public function show_marques_details($marques_id) {
       
        ?>

       <link rel="stylesheet" type="text/css" href="styles/marques.css">
       
       <?php
        $cf =  new MarquesController();
        $marques = $cf->BigZone1();//récupèrer les données du controleur(les marques principales)
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
      ?>
      <div>
          <?php
         $counter = 0;

          foreach ($cars as $car):
         // Limit the loop to two iterations; pour afficher que les 2 principales voitures
         if ($counter < 2):
          ?>   
               <div class="car-by-marque-container">
              <p ><span>Le modèle:</span><?php echo $car['modele']; ?></p>
              <a ><img src="<?php echo $car['image_vehicule']; ?>"></img></a>
               </div>
              <?php
             $counter++;
             endif;
             endforeach;
               ?>
          
     </div>
     <form id="FormCar" action="/Tidjelabine/TraitementListeAvis" method="post">
    <div>
        <label id="Choisir-voiture" for="carSelect" style="color: #cf0015; text-align: center; margin-bottom: 10px; font-weight: bold; font-style: italic; font-size: large;">Choisissez un véhicule :</label>
        <select name="vehiculeId" id="carSelect">
        <option value="">Véhicule</option>
            <?php foreach ($cars as $car): ?>
               
                <option value="<?php echo $car['id_vehicule']; ?>"><?php echo $car['modele'] . ' - ' . $car['version'] . ' (' . $car['annee'] . ')'; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Voir Détails des avis du Véhicule">
</form>
      <!-- fin de la boucle des marques--->  
     <?php endif; ?>
     <?php endforeach; ?>
            
        
        <?php
         
    }

    public function show_vehic_details($id_vehicule){ //une page contenant le nom et l’image du véhicule, un lien vers sa page 
        //de description et tous les avis sur ce véhicule paginé par 5 avis affiché à la fois. 
    
            $cf = new VehiculeController();
            $vehiculeFavs=$cf->cars_details($id_vehicule);
            $marque_vehicule = $cf->get_marque_vehicule($id_vehicule);//récupèrer le nom de la marque
            $nom_marque_vehicule= $marque_vehicule[0]['nom_marque'];
           
        ?>
        <link rel="stylesheet" type="text/css" href="styles/user.css">
        <script src="js/avis.js"></script>
        <script src="js/marques.js"></script>
        <div class="profile-container">
        <div class="profile-details">
            <div class="car-item">
            <?php foreach ($vehiculeFavs as $vehiculeFav): ?>
         <div id="cliqueFav" data-vehicle-id="<?php echo $id_vehicule; ?>">
           <img style="cursor:pointer;" src="<?php echo $vehiculeFav['image_vehicule']; ?>">
         </div>
                 <h2><?php echo $vehiculeFav['modele']; ?></h2>
                 
    
                 <p>Marque : <?php echo $nom_marque_vehicule; ?></p>
                 <p>Version : <?php echo $vehiculeFav['version']; ?></p>
                 <p>Année : <?php echo $vehiculeFav['annee']; ?></p>
             
             </div>
             <form action="/Tidjelabine/TraitementListe" method="post"><input name="vehiculeId" value="<?php echo $id_vehicule?>" hidden ><button style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #c5a173; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="this.form.submit()">Plus de détails</button></form>
             <?php endforeach; ?>
             </div>  
            </div>
            </div>
            <?php
        $cntr = new VehiculeController();
        $resultats_avis = $cntr->voir_tous_avis($id_vehicule);
        ?>
            <div id="tousAvis" class="show-Avis-container">
           <!---liste des avis qui seront paginé à 5 a la fois-->
            <ul>
        <?php 
        
        $count = 0;
        foreach ($resultats_avis as $avis) : 
            if ($count < 5) :
        ?>
        <!--PARTIIIIIIIIE SECTION COMMENTAIREEEES SUR LES VEHICULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLES-->


            <li style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">

            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) : ?>
            <!-- que siiiiiiiiii L'utilisateur est connecté, afficher le lien de like -->
            <a id="AvisLikee"  href="javascript:void(0);" onclick="submitFormAvisV(<?php echo $avis['id_avis']; ?> , <?php echo $id_vehicule; ?>)"> 
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
                    <span class="avisLike<?php echo $avis['id_avis']; ?>"  style="font-style: italic; color: #555; font-size: smaller;">
                                          <?php echo $avis['nbr_apreciations']; ?> 
                    </span>
                    <span id="avis-date_avis" style="font-style: italic; color: #555; font-size: smaller;">
                        , publié le :<?php echo date('d-m-Y H:i:s', strtotime($avis['date_avis'])); ?>
                    </span>
                </div>
            </li>
        <?php 
            endif;
            $count++;
        endforeach; 
        ?>
    </ul>
    <?php if (count($resultats_avis) > 5) : ?>
        <!---bouton qui appelle la fonction javascript quipermet la pagination de 5 avis-->
        <button id="loadMoreButton" style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #cf0015; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="paginerAvis(<?php echo $id_vehicule; ?>)">Voir plus d'avis</button>
    <?php endif; ?>
</div>


     
      <?php
    }

   
}
?>
