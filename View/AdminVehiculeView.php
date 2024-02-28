<?php
require_once ('template.php');

class AdminVehiculeView extends template{


    public function index(){

        $this->main();
        $this->show_marques();
        //$this->show_vehicules();
        $this->show_footer();

     }


     public function show_marques(){//fct qui affiche a l admin les informations des marques
        ?>
        <link rel="stylesheet" type="text/css" href="styles/admin.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- Insérer cette balise "link" après celle de Bootstrap -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<!-- Insérer cette balise "script" après celle de Bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

       <script src="js/admin.js"></script>
         <?php
        $cf =  new MarquesController();//appeler le controller
        $marques = $cf->BigZone1();//récupèrer les données du controleur(les marques existantes )
        ?>
        <div style="height: 20px;"></div>
          <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les marques</h1>
        <!--tableau admin marques-->
        <section class="container">
        <div class="row">
            <div class="col-12">
            <a style="cursor: pointer;" onclick="afficherFormulaireAjouter()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
          <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID</th><th data-sortable="true" data-field="nom" data-searchable="true">Nom Marque</th><th data-sortable="true" data-field="pays" data-searchable="true">Pays Origine</th><th>Siège Social (ville)</th><th data-sortable="true" data-field="date" data-searchable="true">Année de Création</th><th>Lien</th><th>Image</th><th>Véhicules</th><th>Gestion</th></tr></thead>
          <tbody>
          <?php foreach($marques as $marque):?>
          <tr>
            <td><?php echo $marque['id_marque']; ?></td>
            <td><?php echo $marque['nom_marque']; ?></td>
            <td><?php echo $marque['pays_origine']; ?></td>
            <td><?php echo $marque['siege_social']; ?></td>
            <td><?php echo $marque['annee_creation']; ?></td>
            <td><a href="<?php echo $marque['lien_marque']; ?>"><?php echo $marque['lien_marque']; ?></a></td>
            <td> <img style ="width:100px; height:100px" src=<?php echo $marque['image_marque']; ?>></td>
            <td><form action="/Tidjelabine/AdminVehiculesMarques" method="post"> <input name="showVehicMarque" value=<?php echo $marque['id_marque'];?> hidden><input style="background-color: #c5a173; color: white; padding: 10px 15px; border-radius: 4px;cursor: pointer;" value="Véhicules" type="submit"></form></td>
            <td>   <!--lien de suppression et modification marqie-->
            <a href="/Tidjelabine/Controller/apiroute.php?marqueIdS=<?php echo $marque['id_marque']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
            <a style="cursor: pointer;" onclick="afficherFormulaireModification(<?php echo $marque['id_marque']; ?>, '<?php echo $marque['nom_marque']; ?>', '<?php echo $marque['pays_origine']; ?>', '<?php echo $marque['siege_social']; ?>', <?php echo $marque['annee_creation']; ?>, '<?php echo $marque['lien_marque']; ?>', '<?php echo $marque['image_marque']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
          </tr>
          
          <?php endforeach;?>
          </tbody>
          </table>
            </div>
        </div>
          </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

          <!-- formulaire de modification Marque-->
        <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="modifierForm" style="display: none;">
             <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire modification Marque</span>
        <label for="id_marque" hidden></label>
            <input type="number" id="id_marque" name="id_marque_modifier" hidden>
            <label for="nom_marque">Nom de la marque:</label>
            <input type="text" id="nom_marque" name="nom_marque_modifier">
            <label for="pays_origine">pays de la marque:</label>
            <input type="text" id="pays_origine" name="pays_origine_modifier">
            <label for="siege_social">Siege de la marque:</label>
            <input type="text" id="siege_social" name="siege_social_modifier">
            <label for="annee_creation">annee_creation:</label>
            <input type="number" id="annee_creation" name="annee_creation_modifier"  min="1800" max="2099">
            <label for="lien_marque">lien_marque:</label>
            <input type="text" id="lien_marque" name="lien_marque_modifier">
            <label for="image_marque">image_marque:</label>
            <input type="text" id="image_marque" name="image_marque_modifier">
           <button id="btnModifier" onclick="this.form.submit()" name="modifierMarque">Modifier Marque</button>
            
        </form>
         <!-- formulaire d'ajouter une marque -->
         <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="AjouterForm" style="display: none;">
         <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout Marque</span>
             <label for="id_marque" hidden></label>
            <input type="number" id="id_marque" name="id_marque_A" hidden>
            <label for="nom_marque">Nom de la marque:</label>
            <input type="text" id="nom_marque" name="nom_marque_A" required>
            <label for="pays_origine">pays de la marque:</label>
            <input type="text" id="pays_origine" name="pays_origine_A" required>
            <label for="siege_social">Siege de la marque:</label>
            <input type="text" id="siege_social" name="siege_social_A" required>
            <label for="annee_creation">annee_creation:</label>
            <input type="number" id="annee_creation" name="annee_creation_A"  min="1800" max="2099" required>
            <label for="lien_marque">lien_marque:</label>
            <input type="text" id="lien_marque" name="lien_marque_A" required>
            <label for="image_marque">image_marque:</label>
            <input type="text" id="image_marque" name="image_marque_A" required>
           <button id="btnModifier" onclick="this.form.submit()" name="AjouterMarque">Ajouter Marque</button>
            
        </form>
       <?php
     }


     public function show_vehicules($marqueId){
      ?>
      <link rel="stylesheet" type="text/css" href="styles/admin.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- Insérer cette balise "link" après celle de Bootstrap -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<!-- Insérer cette balise "script" après celle de Bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
      <script src="js/admin.js"></script>
      
         <?php
        //$cf =  new VehiculeController();
        //$vehicules = $cf->get_all_cars();//récupèrer les données du controleur(les voitures)
        $cf =  new MarquesController();
        $vehicules= $cf->pcars_by_marque($marqueId);//récupèrer les données du controleur(les voitures)

            $cf =  new AccueilController();
            $marques_toutes = $cf->marques();//récupèrer les données du controleur(les marques principales)
           
        ?>
          <div style="height: 50px;"></div>
          <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les véhicules</h1>
          <form id="hiddenForm3" action="/Tidjelabine/TraitementListe" method="post" style="display: none;">
            <input id="idVehiculeCliquee" type="hidden" name="vehiculeId"  >
            </form>
    
            <script>
             function showDetails(idVehiculeClique) {
               //modifier value de input pour envoyer en POST au VEHICULECONTROLLER METHOD traitementformulaire(); pr aficher les details vehicule cliqué
              $('#idVehiculeCliquee').val(idVehiculeClique);
              // recuperer le formulaire en haut par son id
              var form = document.getElementById('hiddenForm3');
               // Soumettre le formulaire
             form.submit();
               }
            </script>
          <section class="container">
        <div class="row">
            <div class="col-12">
            <a style="cursor: pointer;" onclick="afficherFormulaireVAjouter()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
		
          <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID</th><th data-sortable="true" data-field="marque" data-searchable="true">Marque</th><th data-sortable="true" data-field="modele" data-searchable="true">Modele</th><th>Version</th><th data-sortable="true" data-field="date" data-searchable="true">Année</th><th>Lien</th><th>Gestion</th></tr></thead>
          <tbody>
         
          <?php foreach($vehicules as $vehicule):?>
            <?php
        $cf =  new VehiculeController();
        $marque_vehicule = $cf->get_marque_vehicule($vehicule['id_vehicule']);//récupèrer le nom de la marque
        $nom_marque_vehicule= $marque_vehicule[0]['nom_marque'];
        ?>
          <tr>
            <td><?php echo $vehicule['id_vehicule']; ?></td>
            <td><?php echo $nom_marque_vehicule ; ?></td>
            <td><?php echo $vehicule['modele']; ?></td>
            <td><?php echo $vehicule['version']; ?></td>
            <td><?php echo $vehicule['annee']; ?></td>
           
            <!--lien afficher les details-->
            <td> <a href="javascript:void(0);" onclick="showDetails(<?php echo $vehicule['id_vehicule']; ?>)">Détails</a></td>
            <!--td><a id="details" onclick="afficherVehiculeDetails(<!-?php echo $vehicule['id_vehicule']; ?>,'<!-?php echo $vehicule['dimensions']; ?>','<!-?php echo $vehicule['consommation']; ?>','<!-?php echo $vehicule['moteur']; ?>','<!-?php echo $vehicule['performances']; ?>',<!-?php echo $vehicule['type_vehicule']; ?>,<!-?php echo $vehicule['tarif']; ?>,'<!-?php echo $vehicule['image_vehicule']; ?>','<!-?php echo $vehicule['capacite_moteur']; ?>','<!-?php echo $vehicule['poids']; ?>','<!-?php echo $vehicule['capacite_reservoir']; ?>','<!-?php echo $vehicule['vitesse_max']; ?>','<!-?php echo $vehicule['style']; ?>','<!-?php echo $vehicule['type_carburant']; ?>','<!-?php echo $vehicule['transmission']; ?>',<!-?php echo $vehicule['nombre_portes']; ?>,<!-?php echo $vehicule['nombre_places']; ?>)">Détails</a></td>
           <!-modifier et supp-->
            <td><a style="cursor: pointer;" href="/Tidjelabine/Controller/apiroute.php?vehiculeIdS=<?php echo $vehicule['id_vehicule']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
            <a style="cursor: pointer;" onclick="afficherFormulaireModificationVehicule(<?php echo $vehicule['id_vehicule']; ?>, <?php echo $vehicule['id_marque']; ?>,'<?php echo $vehicule['modele']; ?>','<?php echo $vehicule['version']; ?>',<?php echo $vehicule['annee']; ?> ,'<?php echo $vehicule['dimensions']; ?>','<?php echo $vehicule['consommation']; ?>','<?php echo $vehicule['moteur']; ?>','<?php echo $vehicule['performances']; ?>','<?php echo $vehicule['couleur']; ?>',<?php echo $vehicule['type_vehicule']; ?>,<?php echo $vehicule['tarif']; ?>,'<?php echo $vehicule['image_vehicule']; ?>','<?php echo $vehicule['capacite_moteur']; ?>','<?php echo $vehicule['poids']; ?>','<?php echo $vehicule['capacite_reservoir']; ?>','<?php echo $vehicule['vitesse_max']; ?>','<?php echo $vehicule['style']; ?>','<?php echo $vehicule['type_carburant']; ?>','<?php echo $vehicule['transmission']; ?>',<?php echo $vehicule['nombre_portes']; ?>,<?php echo $vehicule['nombre_places']; ?>)"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
          </tr>
          
          <?php endforeach;?>
        
          </table>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <!-- formulaire de modification Vehicule-->
   <div id="modVForm" class="form-container" style="display: none;">
   
   <form action="/Tidjelabine/Controller/apiroute.php" method="post">
   <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification Véhicule</span>     
             <label for="id_vehicule" hidden></label>
            <input type="number" id="id_vehicule" name="id_vehicule_modifier" hidden>
            <label for="nom_marque">Nom de la marque:</label>


            <select name="nom_marque" id="nom_marque" >
                            <!--les options pour les marques -->
                            
                            <?php foreach ($marques_toutes as $marque_toute): ?>
                            <option value="<?= $marque_toute['id_marque'] ?>"><?= $marque_toute['nom_marque'] ?></option>
                            <?php endforeach; ?>
                        
                        </select>

            <label for="modele">Modele:</label>
            <input type="text" id="modele" name="modele_modifier">
            <label for="version">Version:</label>
            <input type="text" id="version" name="version_modifier">
            <label for="annee">annee:</label>
            <input type="number" id="annee" name="annee_modifier"  min="1800" max="2099">
            <label for="dimensions">dimensions:</label>
            <input type="text" id="dimensions" name="dimensions_modifier">
            <label for="consommation">consommation:</label>
            <input type="text" id="consommation" name="consommation_modifier">
            <label for="moteur">moteur:</label>
            <input type="text" id="moteur" name="moteur_modifier">
            <label for="performances">performances:</label>
            <input type="text" id="performances" name="performances_modifier">
            <label for="couleur">couleur:</label>
            <input type="text" id="couleur" name="couleur_modifier">
            <label for="type_vehicule">type_vehicule:</label>
            <input type="number" id="type_vehicule" name="type_vehicule_modifier">
            <label for="tarif">tarif:</label>
            <input type="number" id="tarif" name="tarif_modifier">
            <label for="image_vehicule">image_vehicule:</label>
            <input type="text" id="image_vehicule" name="image_vehicule_modifier">
            <label for="capacite_moteur">Capacité moteur:</label>
            <input type="text" id="capacite_moteur" name="capacite_moteur_modifier">
            <label for="poids">Poids:</label>
            <input type="text" id="poids" name="poids_modifier">
            <label for="capacite_reservoir">Capacité reservoir:</label>
            <input type="text" id="capacite_reservoir" name="capacite_reservoir_modifier">
            <label for="vitesse_max">Vitesse Maximale:</label>
            <input type="text" id="vitesse_max" name="vitesse_max_modifier">
            <label for="style"> style:</label>
            <input type="text" id="style" name="style_modifier">
            <label for="type_carburant"> Type carburant:</label>
            <input type="text" id="type_carburant" name="type_carburant_modifier">
            <label for="transmission"> Transmission:</label>
            <input type="text" id="transmission" name="transmission_modifier">
            <label for="nombre_portes"> nombre de portes:</label>
            <input type="number" id="nombre_portes" name="nombre_portes_modifier" min="1" max="10">
            <label for="nombre_places"> Nombre de places:</label>
            <input type="number" id="nombre_places" name="nombre_places_modifier" min="1" max="40">
           
            <button id="btnModifierV" onclick="this.form.submit()" name="modifierVehicule">Modifier Vehicule</button>
            
        </form>
        </div>


        <!-- formulaire d ajout d un  Vehicule-->
   <div id="ajoutVForm" class="form-container" style="display: none;"> 
       
       <form action="/Tidjelabine/Controller/apiroute.php" method="post">
       <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout Vehicule</span>
           <label for="id_vehicule_A" hidden></label>
            <input type="number" id="id_vehicule_A" name="id_vehicule_A" hidden>
           
            <label for="nom_marque">Nom de la marque:</label>


            <select name="nom_marque_ajouter" id="nom_marque_ajouter" required>
                            <!--les options pour les marques -->
                            
                            <?php foreach ($marques_toutes as $marque_toute): ?>
                            <option value="<?= $marque_toute['id_marque'] ?>"><?= $marque_toute['nom_marque'] ?></option>
                            <?php endforeach; ?>
                        
                        </select>

            <label for="modele">Modele:</label>
            <input type="text" id="modele" name="modele_A" required>
            <label for="version">Version:</label>
            <input type="text" id="version" name="version_A" required>
            <label for="annee">annee:</label>
            <input type="number" id="annee" name="annee_A"  min="1800" max="2099">
            <label for="dimensions">dimensions:</label>
            <input type="text" id="dimensions" name="dimensions_A">
            <label for="consommation">consommation:</label>
            <input type="text" id="consommation" name="consommation_A">
            <label for="moteur">moteur:</label>
            <input type="text" id="moteur" name="moteur_A">
            <label for="performances">performances:</label>
            <input type="text" id="performances" name="performances_A">
            <label for="couleur">couleur:</label>
            <input type="text" id="couleur" name="couleur_A">
            <label for="type_vehicule">type_vehicule:</label>
            <input type="number" id="type_vehicule" name="type_vehicule_A">
            <label for="tarif">tarif:</label>
            <input type="number" id="tarif" name="tarif_A">
            <label for="image_vehicule">image_vehicule:</label>
            <input type="text" id="image_vehicule" name="image_vehicule_A">
            <label for="capacite_moteur">Capacité moteur:</label>
            <input type="text" id="capacite_moteur" name="capacite_moteur_A">
            <label for="poids">Poids:</label>
            <input type="text" id="poids" name="poids_A">
            <label for="capacite_reservoir">Capacité reservoir:</label>
            <input type="text" id="capacite_reservoir" name="capacite_reservoir_A">
            <label for="vitesse_max">Vitesse Maximale:</label>
            <input type="text" id="vitesse_max" name="vitesse_max_A">
            <label for="style"> style:</label>
            <input type="text" id="style" name="style_A">
            <label for="type_carburant"> Type carburant:</label>
            <input type="text" id="type_carburant" name="type_carburant_A">
            <label for="transmission"> Transmission:</label>
            <input type="text" id="transmission" name="transmission_A">
            <label for="nombre_portes"> nombre de portes:</label>
            <input type="number" id="nombre_portes" name="nombre_portes_A" min="1" max="10">
            <label for="nombre_places"> Nombre de places:</label>
            <input type="number" id="nombre_places" name="nombre_places_A" min="1" max="40">
           
            <button id="btnAjouterV" onclick="this.form.submit()" name="AjouterVehicule">Ajouter Vehicule</button>
            
        </form>
        </div>

        
      <?php
     }
     
}
?>
