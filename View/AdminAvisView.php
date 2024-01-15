<?php
require_once ('template.php');

class AdminAvisView extends template{


    public function index(){

        $this->main();
        $this->show_avis();
        $this->show_footer();
        

     }
     public function show_avis(){
      ?>
      <link rel="stylesheet" type="text/css" href="styles/admin.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!--  cette balise "link" après celle de Bootstrap -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<!-- cette balise "script" après celle de Bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
     <script src="js/admin.js"></script>
       <?php
       // TRIER LE TABLEAU PAR STATUT
       function comparerParStatut($avis1, $avis2) {
          return strcmp($avis1['statut'], $avis2['statut']);
         }
      $cf =  new AdminAVisController();
      $aviss = $cf->get_all_avis();//récupèrer les données du controleur(les marques principales)
      // Trier les avis en utilisant la fonction de comparaison
      usort($aviss, 'comparerParStatut');
      ?>
      <div style="height: 20px;"></div>
        <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les Avis</h1>
    
        <section class="container">
        <div class="row">
        <div class="col-12">
        <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
		
        <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID AVIS</th><th data-sortable="true" data-field="commentaire" data-searchable="true">Commentaire</th><th>Utilisateur ayant émis</th><th data-sortable="true" data-field="vehicule" data-searchable="true">Vehicule avisé</th><th data-sortable="true" data-field="statut" data-searchable="true">Statut</th><th>Gestion</th></tr></thead>
        <tbody>
        <?php foreach($aviss as $avis):?>
          <?php
      $cf =  new VehiculeController();
      $marque_vehicule = $cf->get_marque_vehicule($avis['id_vehicule']);//récupèrer le nom de la marque
      $nom_marque_vehicule= $marque_vehicule[0]['nom_marque'];
      ?>
        <tr>
          <td> <?php echo $avis['id_avis']; ?></td>
          <td> <?php echo $avis['commentaire']; ?></td>
          <td> <?php echo $avis['id_utilisateur']; ?> , <?php echo $avis['nom']; ?> , <?php echo $avis['prenom']; ?></td>
          <td> <?php echo $avis['id_vehicule']; ?> , <?php echo $nom_marque_vehicule; ?><?php echo $avis['modele']; ?> , <?php echo $avis['version']; ?> , <?php echo $avis['annee']; ?></td>
          <td> <?php echo $avis['statut']; ?></td>
          <!--refuser le commentaire ou bloquer l'utilisateur--->
          <td><a href="/Tidjelabine/Controller/apiroute.php?avisS=<?php echo $avis['id_avis']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> <a href="/Tidjelabine/Controller/apiroute.php?avisV=<?php echo $avis['id_avis']; ?>"><img src="images/cocher.png" width="20" height="20"></a><a href="/Tidjelabine/Controller/apiroute.php?utilisateurS=<?php echo $avis['id_utilisateur']; ?>"><img src="images/bloquer-un-utilisateur.png" width="20" height="20"></a></td>
         </tr>
         
        <?php endforeach;?>
        </table>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- formulaire de modification Marque-->
      <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="modifierForm" style="display: none;">
      <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification Avis</span> 
           <label for="id_marque" hidden>Nom de la marque:</label>
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
       <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification Marque</span> 
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

   



}