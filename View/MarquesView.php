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
       
       
     <?php
      
        $cf =  new MarquesController();
        $marques = $cf->BigZone1();//récupèrer les données du controleur(les marques principales)
    ?>
        <div id="Bzone1" class="Bzone1-container">
            <?php foreach ($marques as $marque): ?>
                <p class="marque-name"><?php echo $marque['nom_marque']; ?></p>
                <a class="marques-scroll" data-id="<?php echo $marque['id_marque']; ?>"  data-marque="<?php echo $marque['nom_marque']; ?>">
                    <img src="<?php echo $marque['image_marque']; ?>" alt="<?php echo $marque['nom_marque']; ?>">                 
                </a>
               
            <?php endforeach; ?> 
            
            
        </div>
       
        <div id="marques-details-container"> 
        <?php
        

// Accéder à la valeur de l'ID depuis la session
if (isset($_SESSION['marqueId'])) {
    $marqueId = $_SESSION['marqueId'];
    echo 'La valeur de l\'ID de la marqueeeeeeeeeeeeeeee est : ' . $marqueId;
    $this->showBigZone2($marqueId);
       /* unset($_SESSION['marqueId']);
    session_destroy();*/
    
} else {
    echo 'Aucune valeur d\'ID de marque trouvée dans la session.';
}

        ?>
        </div>
       
        
        <?php
    }


   /*fonction qui affiche les details d'une marque donnée par id */
    public function showBigZone2($marques_id) {
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
     <form id="FormCar" action="/Tidjelabine/TraitementListe" method="post">
    <div>
        <label id="Choisir-voiture" for="carSelect" style="color: #cf0015; text-align: center; margin-bottom: 10px; font-weight: bold; font-style: italic; font-size: large;">Choisissez un véhicule :</label>
        <select name="vehiculeId" id="carSelect">
            <?php foreach ($cars as $car): ?>
                <option value="">Véhicule</option>
                <option value="<?php echo $car['id_vehicule']; ?>"><?php echo $car['modele'] . ' - ' . $car['version'] . ' (' . $car['annee'] . ')'; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Valider">
</form>
      <!-- fin de la boucle des marques--->  
     <?php endif; ?>
     <?php endforeach; ?>
            
        
        <?php
    }
  

}
?>
