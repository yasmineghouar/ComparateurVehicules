<?php
require_once ('template.php');

class VehiculeView extends template{
 

    public function index(){

       $this->main();
       
       
    }
    
   /* public function show_entete_comparaison(){//entete de la page comparaison ( venant de l'acceuil)
      
    }


    public function showDonnerAvis()
    {
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            ?>
            <div id="donnerAvis" class="showDonner-container">
                <label for="avis">Votre avis :</label>
                <textarea id="avis" name="avis" rows="4" cols="50"></textarea>
            </div>
            <?php
           
        }
    }
    


    public function showDonnerNote($vehicule_id){
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            ?>
            <div id="donnerNote" class="showDonner-container">
        <form action="" method="post">
             <!--soumission formulaires reinitialise ttes les variables php-->
             <select id="evaluation" name="note">
             <option value="1">1 étoile</option>
             <option value="2">2 étoiles</option>
              <option value="3">3 étoiles</option>
             <option value="4">4 étoiles</option>
             <option value="5">5 étoiles</option>
             </select>

    <button type="submit">Envoyer l'avis</button>
        </form>
            </div>
            <?php
             if (isset($_POST['note'])){
                $cntr= new VehiculeController();
                $note=$_POST['note'];
                $id_utilisateur=$_SESSION["user"];
                $cntr->insertNote($id_utilisateur,$vehicule_id,$note);
                }
        }
    }*/


    public function showVehiculeDetails($vehicule_id) {
        ?>
        
        <link rel="stylesheet" type="text/css" href="styles/vehicule.css"></link>
       <script src="js/marques.js"></script>
       <script src="js/accueil.js"></script>
    </br></br></br></br>
       
    
        <?php
        $cfAcc =  new AccueilController();
        $marques = $cfAcc->marques();//récupèrer les données du controleur(les marques principales)
        $cf = new VehiculeController();
        $details = $cf->cars_details($vehicule_id); // récupérer les données du contrôleur (lesdetails du vehicule donné)
        $marque_vehicule = $cf->get_marque_vehicule($vehicule_id);//récupèrer le nom de la marque
        $nom_marque_vehicule= $marque_vehicule[0]['nom_marque'];
        $noteVehiccule= $cf->getMoyenneNotesVehicule($vehicule_id);
        ?>
        
        <?php foreach ($details as $detail): ?>
        
            <div id="vehicule-<?php echo $detail['id_vehicule']; ?>" class="vehicule-details">
    <!-- les informations détaillées du vehicule -->
    <h1>Détails du véhicule:</h1>
    <img id="vehicule-imagee" style="width: 800px; height:350px ;  margin-left: 300px; max-width:100%;" src="<?php echo $detail['image_vehicule']; ?>"></img>
    <table>
        <!--vehicle type -->
        <tr>
            <td><strong>Type Du Véhicule:</strong></td>
            <td><?php 
                if ($detail['type_vehicule'] == 1) {
                    echo 'Voiture';
                } elseif ($detail['type_vehicule'] == 2) {
                    echo 'Camion';
                } elseif ($detail['type_vehicule'] == 3) {
                    echo 'Moto';
                } else {
                    echo 'Inconnu';
                }
            ?></td>
        </tr>
        <tr>
            <td><strong>Marque :</strong></td>
            <td><?php echo $nom_marque_vehicule; ?></td>
        </tr>
        <tr>
            <td><strong>Modèle :</strong></td>
            <td><?php echo $detail['modele']; ?></td>
        </tr>
        <tr>
            <td><strong>Version :</strong></td>
            <td><?php echo $detail['version']; ?></td>
        </tr>
        <tr>
            <td><strong>Année :</strong></td>
            <td><?php echo $detail['annee']; ?></td>
        </tr>
        <tr>
            <td><strong>Dimensions:</strong></td>
            <td><?php echo $detail['dimensions']; ?></td>
        </tr>
        <tr>
            <td><strong>Poids étant vide:</strong></td>
            <td><?php echo $detail['poids']; ?></td>
        </tr>
        <tr>
            <td><strong>Nombre de Portes :</strong></td>
            <td><?php echo $detail['nombre_portes']; ?></td>
        </tr>
        <tr>
            <td><strong>Nombre de Places :</strong></td>
            <td><?php echo $detail['nombre_places']; ?></td>
        </tr>
        <tr>
            <td><strong>Style du véhicule :</strong></td>
            <td><?php echo $detail['style']; ?></td>
        </tr>
        <tr>
            <td><strong>Type du carburant :</strong></td>
            <td><?php echo $detail['type_carburant']; ?></td>
        </tr>
        <tr>
            <td><strong>Transmission :</strong></td>
            <td><?php echo $detail['transmission']; ?></td>
        </tr>
        <tr>
            <td><strong>Consommation :</strong></td>
            <td><?php echo $detail['consommation']; ?></td>
        </tr>
        <tr>
            <td><strong>Moteur :</strong></td>
            <td><?php echo $detail['moteur']; ?></td>
        </tr>
        <tr>
            <td><strong>Puissance :</strong></td>
            <td><?php echo $detail['performances']; ?></td>
        </tr>
        <tr>
            <td><strong>Capacité Moteur :</strong></td>
            <td><?php echo $detail['capacite_moteur']; ?></td>
        </tr>
        <tr>
            <td><strong>Capacité du réservoir :</strong></td>
            <td><?php echo $detail['capacite_reservoir']; ?></td>
        </tr>
      
        <tr>
            <td><strong>Vitesse Maximale :</strong></td>
            <td><?php echo $detail['vitesse_max']; ?></td>
        </tr>
        <tr>
            <td><strong>Tarif en DZ :</strong></td>
            <td><?php echo $detail['tarif']; ?></td>
        </tr>
    
    </table>
    
</div>

<div class="show-Avis-container">
             <h2 style="color: #cf0015; font-size: 24px; text-align: center; margin-bottom: 20px; text-transform: uppercase;"> Note moyenne du véhicule: </h2>
            <h2 style="color: #583E26; font-size: 24px; text-align: center; margin-bottom: 20px; text-transform: uppercase;">
                <?php echo number_format($noteVehiccule, 1); ?> /5 
            </h2>
</div>
        <?php endforeach; ?>
<!-- Afficher les 3 meilleurs avis du vehicule -->
            </br></br>
            <div class="show-Avis-container">
            <h2 style="color: #cf0015; font-size: 24px; text-align: center; margin-bottom: 20px; text-transform: uppercase;">
                les 3 meilleurs commentaires 
            </h2>
     <ul>
        <?php
         $cntr= new VehiculeController();
         $resultats_avis = $cntr->troisMeilleursAvis($vehicule_id);//appel a la fonction dans controller qui traite les 3 meilleurs avis
         ?>
         <?php foreach ($resultats_avis as $avis) : ?>
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) : ?>
            <!-- L'utilisateur est connecté, afficher le lien de like -->
            <a id="AvisLikee"  href="javascript:void(0);" onclick="submitFormAvisV(<?php echo $avis['id_avis']; ?> , <?php echo $_SESSION['user']; ?>)"> 
            <img src="images/favorie.png" width="20" height="20" style="margin-top: 5px;">
            </a>
        <?php endif; ?>
               <!---->
            <li>
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
                    <span class="avisLike<?php echo $avis['id_avis']; ?>" style="font-style: italic; color: #555; font-size: smaller;">
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
         </br>
<!-- Le lien qui déclenchera l'affichage de la liste -->
<div id="aff-container">
<a id="afficherAvis">Afficher tous les avis</a>
            </div>
<div id="tousAvis" class="show-Avis-container" style="display: none;">
     <ul>
        <?php
         $cntr= new VehiculeController();
         $resultats_avis = $cntr->voir_tous_avis($vehicule_id);
         ?>
         <?php foreach ($resultats_avis as $avis) : ?>
            <li>
 <!--PARTIIIIIIIIE SECTION COMMENTAIREEEES SUR LES VEHICULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLES-->
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) : ?>
            <!-- L'utilisateur est connecté, afficher le lien de like -->
            <a id="AvisLikee"  href="javascript:void(0);" onclick="submitFormAvisV(<?php echo $avis['id_avis']; ?> , <?php echo $_SESSION['user']; ?>)"> 
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
                    <span  style="font-style: italic; color: #555; font-size: smaller;">
                       nombre de j'aime : 
                    </span>
                    <span class="avisLike<?php echo $avis['id_avis']; ?>" style="font-style: italic; color: #555; font-size: smaller;">
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
/**  PARTIE AJOUTER UN AVIS*/

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    ?>
    
     </br></br>
    <div id="donnerNote" class="show-Donner-container">
<form action="" method="post">
<!--soumission formulaires reinitialise ttes les variables php-->
<input type="hidden" name="vehiculeId" value="<?php echo $vehicule_id; ?>"> 
    <select id="evaluation" name="note">
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

<!-- APPRECIATIONS ( FAVORIS)---------------------------------------------------->
<div style="text-align: center;">
     <h3> Ajouter ce véhicule à vos favoris :  </h3>
     <a href="/Tidjelabine/Controller/Clique_Marques.php?vehicFav=<?php echo $vehicule_id; ?>&UserFav=<?php echo $_SESSION["user"]; ?>"><img src="images/favorie.png" width="40" height="40"></a>
</div>

        
<!--PARTIE AJOUTER AVIS SUR UN VEHICULE-->
</br></br>
     <div id="donnerAvis" class="show-Donner-container">
     <form action="" method="post">
        <input type="hidden" name="vehiculeId" value="<?php echo $vehicule_id; ?>"> 
        <label for="avis" style="font-weight: bold; font-size: 25px;">Votre avis :</label>
        <textarea id="avis" name="avis" rows="4" cols="50"></textarea>
        <button type="submit">Donner un avis</button>
     </form>
     </div>
     </br></br>
    





    <?php
    /**traitement formulaire note */
     if (isset($_POST['note'])){
        $cntr= new VehiculeController();
        // Récupérer la valeur de vehiculeId à partir du champ caché
        $vehicule_id_post = $_POST['vehiculeId'];
        $note=$_POST['note'];
        $id_utilisateur=$_SESSION["user"];
        
        $cntr->insertNote($id_utilisateur,$vehicule_id_post,$note);
        }
/*tariteement formulaire avis */
        if (isset($_POST['avis'])){
            $cntr= new VehiculeController();
            // Récupérer la valeur de vehiculeId à partir du champ caché
            $vehicule_id_post = $_POST['vehiculeId'];
            $commentaire=$_POST['avis'];
            $id_utilisateur=$_SESSION["user"];
            
            $cntr->insertAvis($id_utilisateur, $vehicule_id_post, $commentaire);
            }
}
?>
</br></br>
 <!-- PARTIE LE COMPARRER AVEC D AUTRES VEHICUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLES-->
 <div id="zone2-container">
            <div id="zone2" >
                <!-- Cadre 1 -->
                <div class="cadre" id="cadre1">
                    <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form1" class="formulaire" >
                        <div class="cadre-titre">Ce véhicule </div></br>
                        <label for="marque1">Marque:</label>
                        <select name="marque1" id="marque1" style="width:300px;"  >
                            <!--les options pour les marques -->
                            
                            
                            <option value="<?= $detail['id_marque']?>"><?= $nom_marque_vehicule ?></option>
                            
                        
                        </select>
                        <br>
                        <label for="modele1">Modèle:</label>
                        <select name="modele1" id="modele1" class="modele" >
                         
                        <option value="<?= $detail['modele']?>"><?= $detail['modele'] ?></option>
                        </select>
                        <!--input type="text" name="modele1" id="modele1" required-->
                        <br>
                        <label for="version1">Version:</label>
    
                        <select name="version1" id="version1" class="version" >
                        <option value="<?= $detail['version']?>"><?= $detail['version'] ?></option>
                        <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                        </select>
                        <br>
                        <label for="annee1">Année:</label>
                        
                        <select name="annee1" id="annee1" class="annee">
                        <option value="<?= $detail['annee']?>"><?= $detail['annee'] ?></option>
                         </select>
                    </form>
                </div>
        
                <!-- Cadre 2 -->
                <div class="cadre" id="cadre2">
                    <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form2" class="formulaire">
                        <div class="cadre-titre"> Véhicule 2  </div></br>
                        <label for="marque2">Marque:</label>
                        <select name="marque2" id="marque2" onchange="getModele(this.value, 'modele2')" style="width:300px;">
                            <!-- Ajoutez les options pour les marques -->
                            <option value="">Marque</option> 
                            <?php foreach ($marques as $marque): ?>
                            <option value="<?= $marque['id_marque'] ?>"><?= $marque['nom_marque'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="modele2">Modèle:</label>
                        <select name="modele2" id="modele2" class="modele" onchange="getVersion(this.value, 'version2')">
                            <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                            <option value="">Modele</option> 
                        
                        </select>
                        <!--input type="text" name="modele2" id="modele2" required-->
                        <br>
                        <label for="version2">Version:</label>
                         <select name="version2" id="version2" class="version" onchange="getAnnee(this.value, 'annee2')">
                         <option value="">Version</option> 
                         </select>
                        <br>
                        <label for="annee2">Année:</label>
                        <select name="annee2" id="annee2" class="annee">
                        <option value="">Annee</option> 
                         </select>
                         
                    </form>
                </div>
        
                <!-- Cadre 3 -->
                <div class="cadre" id="cadre3">
                    <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form3" class="formulaire">
                        <div class="cadre-titre">Véhicule 3  </div></br>
                        <label for="marque3">Marque:</label>
                        <select name="marque3" id="marque3" onchange="getModele(this.value, 'modele3')" style="width:300px;">
                            <!-- Ajoutez les options pour les marques -->
                            <option value="">Marque</option> 
                            <?php foreach ($marques as $marque): ?>
                            <option value="<?= $marque['id_marque'] ?>"><?= $marque['nom_marque'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="modele3">Modèle:</label>
                        <select name="modele3" id="modele3" class="modele" onchange="getVersion(this.value, 'version3')">
                            <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                            <option value="">Modele</option> 
                        
                        </select>
                        <!--input type="text" name="modele3" id="modele3" required-->
                        <br>
                        <label for="version3">Version:</label>
                        <select name="version3" id="version3" class="version" onchange="getAnnee(this.value, 'annee3')">
                        <option value="">Version</option> 
                         </select>
                        <br>
                        <label for="annee3">Année:</label>
                        <select name="annee3" id="annee3" class="annee">
                        <option value="">Annee</option> 
                         </select>
                        
                    </form>
                </div>
        
                <!-- Cadre 4 -->
                <div class="cadre" id="cadre4">
                    <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form4" class="formulaire">
                        <div class="cadre-titre">Véhicule 4  </div></br>
                        <label for="marque4">Marque:</label>
                        <select name="marque4" id="marque4" onchange="getModele(this.value, 'modele4')" style="width:300px;">
                            <!-- Ajoutez les options pour les marques -->
                            <option value="">Marque</option> 
                            <?php foreach ($marques as $marque): ?>
                            <option value="<?= $marque['id_marque'] ?>"><?= $marque['nom_marque'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="modele4">Modèle:</label>
                        <!--input type="text" name="modele4" id="modele4" required-->
                        <select name="modele4" id="modele4" class="modele" onchange="getVersion(this.value, 'version4')">
                            <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                            <option value="">Modele</option> 
                        
                        </select>
                        <br>
                        <label for="version4">Version:</label>
                        <select name="version4" id="version4" class="version" onchange="getAnnee(this.value, 'annee4')">
                        <option value="">Version</option> 
                         </select>
                        <br>
                        <label for="annee4">Année:</label>
                        <select name="annee4" id="annee4" class="annee">
                        <option value="">Annee</option> 
                         </select>
                    </form>
                </div>
            </div>
        
             <!-- Bouton de comparaison -->
            <button id="Comparer">Comparer le véhicule courant avec d'autres</button>

            </div>
            </br></br>
            <?php
              $cf = new AccueilController();
              $veh_cf = new VehiculeController();
              $mostPopularComparison = $veh_cf->getMostPopularComparisonForVehicle($vehicule_id);/*recuperer les id des vehciules les plus comparés eavec ce vehicule en cours */
              $secondMostPopularComparison = $veh_cf->getSecondPopularComparisonForVehicle($vehicule_id);/*recuperer les id des vehciules les plus comparésaevc ce vehicule 2e position*/
              
    // $this->show_popular_comparaison($vehicule_id); 
    $this->show2PopularComparaison($mostPopularComparison,$secondMostPopularComparison);//appel fct dans template qui affiche les 2 comparaisons les plus populaires
             ?>
            <!---------------------------------------------->
            <!------------------------------------------------->
            
<?php
    }

   

    

}

?>
