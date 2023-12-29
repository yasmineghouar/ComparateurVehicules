<?php
require_once ('template.php');

class ComparateurView extends template{
 

    public function index(){

       $this->main();
         
        $this->showZone2();
       

    }
    
 

public function showVehiculeDetailsMultiple4($details1, $details2, $details3, $details4) {
    ?>
    <link rel="stylesheet" type="text/css" href="../styles/Comparateur.css"></link>
    <script src="js/marques.js"></script>
    </br></br></br></br>
     <?php foreach ($details1 as $detail1): ?>
     <?php foreach ($details2 as $detail2): ?>
     <?php foreach ($details3 as $detail3): ?>
     <?php foreach ($details4 as $detail4): ?>
         <div id="vehicule-<?php echo $detail['id_vehicule']; ?>" class="vehicule-details">
 <!-- les informations détaillées du vehicule -->
 <h1>Comparaisons des véhicules:</h1>
 
 <table>
     <!--vehicle type -->
     <tr>
                <td><strong>Type Du Véhicule:</strong></td>
                <td><?php echo $this->getTypeLabel($detail1['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail2['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail3['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail4['type_vehicule']); ?></td>
     </tr>
     <tr>
     <td><strong>Image du Véhicule :</strong></td>
         <td><img class="vehicule-image" src="../<?php echo $detail1['image_vehicule']; ?>"></img></td>
         <td><img class="vehicule-image" src="../<?php echo $detail2['image_vehicule']; ?>"></img></td>
         <td><img class="vehicule-image" src="../<?php echo $detail3['image_vehicule']; ?>"></img></td>
         <td><img class="vehicule-image" src="../<?php echo $detail4['image_vehicule']; ?>"></img></td>
     </tr>
     <tr>
     <td><strong>Marque :</strong></td>
         <td><?php echo $detail1['id_marque']; ?></td>
         <td><?php echo $detail2['id_marque']; ?></td>
         <td><?php echo $detail3['id_marque']; ?></td>
         <td><?php echo $detail4['id_marque']; ?></td>
     </tr>
     <tr>
     <td><strong>Modele :</strong></td>
         <td><?php echo $detail1['modele']; ?></td>
         <td><?php echo $detail2['modele']; ?></td>
         <td><?php echo $detail3['modele']; ?></td>
         <td><?php echo $detail4['modele']; ?></td>
     </tr>
     <tr>
     <td><strong>Version :</strong></td>
         <td><?php echo $detail1['version']; ?></td>
         <td><?php echo $detail2['version']; ?></td>
         <td><?php echo $detail3['version']; ?></td>
         <td><?php echo $detail4['version']; ?></td>
     </tr>
     <tr>
        <td><strong>Année :</strong></td>
        <td><?php echo $detail1['annee']; ?></td>
        <td><?php echo $detail2['annee']; ?></td>
        <td><?php echo $detail3['annee']; ?></td>
        <td><?php echo $detail4['annee']; ?></td>
    </tr>
    <tr>
       <td><strong>Dimensions :</strong></td>
        <td><?php echo $detail1['dimensions']; ?></td>
        <td><?php echo $detail2['dimensions']; ?></td>
        <td><?php echo $detail3['dimensions']; ?></td>
        <td><?php echo $detail4['dimensions']; ?></td>
    </tr>
    <tr>
        <td><strong>Consommation :</strong></td>
        <td><?php echo $detail1['consommation']; ?></td>
        <td><?php echo $detail2['consommation']; ?></td>
        <td><?php echo $detail3['consommation']; ?></td>
        <td><?php echo $detail4['consommation']; ?></td>
    </tr>
    <tr>
        <td><strong>Moteur :</strong></td>
        <td><?php echo $detail1['moteur']; ?></td>
        <td><?php echo $detail2['moteur']; ?></td>
        <td><?php echo $detail3['moteur']; ?></td>
        <td><?php echo $detail4['moteur']; ?></td>
    </tr>
    <tr>
         <td><strong>Performances :</strong></td>
        <td><?php echo $detail1['performances']; ?></td>
        <td><?php echo $detail2['performances']; ?></td>
        <td><?php echo $detail3['performances']; ?></td>
        <td><?php echo $detail4['performances']; ?></td>
    </tr>
    <tr>
        <td><strong>Tarif :</strong></td>
        <td><?php echo $detail1['tarif']; ?></td>
        <td><?php echo $detail2['tarif']; ?></td>
        <td><?php echo $detail3['tarif']; ?></td>
        <td><?php echo $detail4['tarif']; ?></td>
    </tr>
      
 </table>
 <!-- fin infos AJOUTERRRRRRRRRR NOTE !!!!! -->
 </div>
   
     <?php endforeach; ?>
     <?php endforeach; ?>
     <?php endforeach; ?>
     <?php endforeach; ?>
     
     <?php
   
}
/**********************afficher tableau comparaison 2 à 2  */
public function showVehiculeDetailsMultiple2($details1, $details2) {
    ?>
    <link rel="stylesheet" type="text/css" href="../styles/Comparateur.css"></link>
    <script src="../js/marques.js"></script>
    </br></br></br></br>
     <?php foreach ($details1 as $detail1): ?>
     <?php foreach ($details2 as $detail2): ?>
         <div id="vehicule-<?php echo $detail['id_vehicule']; ?>" class="vehicule-details">
 <!-- les informations détaillées du vehicule -->
 <h1>Comparaisons des véhicules:</h1>

 <table>
     <!--vehicle type -->
     <tr>
                <td><strong>Type Du Véhicule:</strong></td>
                <td><?php echo $this->getTypeLabel($detail1['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail2['type_vehicule']); ?></td>
     </tr>
     <tr>
     <td><strong>Image du Véhicule :</strong></td>
         <td><img id="vehicule-image" src="../<?php echo $detail1['image_vehicule']; ?>" data-value="<?php echo $detail1['id_vehicule']; ?>"></img></td>
         <td><img id="vehicule-image" src="../<?php echo $detail2['image_vehicule']; ?>" data-value="<?php echo $detail2['id_vehicule']; ?>"></img></td>
        
     </tr>
     <tr>
     <td><strong>Marque :</strong></td> <td><?php echo $detail1['id_marque']; ?></td><td><?php echo $detail2['id_marque']; ?></td>
     </tr>
     <tr>
     <td><strong>Modele :</strong></td> <td><?php echo $detail1['modele']; ?></td> <td><?php echo $detail2['modele']; ?></td>
     </tr>
     <tr>
     <td><strong>Version :</strong></td> <td><?php echo $detail1['version']; ?></td><td><?php echo $detail2['version']; ?></td>
     </tr>
     <tr>
        <td><strong>Année :</strong></td> <td><?php echo $detail1['annee']; ?></td><td><?php echo $detail2['annee']; ?></td>
    </tr>
    <tr>
       <td><strong>Dimensions :</strong></td><td><?php echo $detail1['dimensions']; ?></td><td><?php echo $detail2['dimensions']; ?></td>
    </tr>
    <tr>
        <td><strong>Consommation :</strong></td><td><?php echo $detail1['consommation']; ?></td><td><?php echo $detail2['consommation']; ?></td>
    </tr>
    <tr>
        <td><strong>Moteur :</strong></td><td><?php echo $detail1['moteur']; ?></td><td><?php echo $detail2['moteur']; ?></td>
    </tr>
    <tr>
         <td><strong>Performances :</strong></td> <td><?php echo $detail1['performances']; ?></td><td><?php echo $detail2['performances']; ?></td>
    </tr>
    <tr>
        <td><strong>Tarif :</strong></td><td><?php echo $detail1['tarif']; ?></td><td><?php echo $detail2['tarif']; ?></td>
    </tr>
      
 </table>
 <!-- fin infos AJOUTERRRRRRRRRR NOTE !!!!! -->
 </div>
   
     <?php endforeach; ?>
     <?php endforeach; ?>
   
     
     <?php
}

/***Afficher tableau de comparaison 3 véhicules */

public function showVehiculeDetailsMultiple3($details1, $details2, $details3) {
    ?>
    <link rel="stylesheet" type="text/css" href="../styles/Comparateur.css"></link>
    <script src="js/marques.js"></script>
    </br></br></br></br>
     <?php foreach ($details1 as $detail1): ?>
     <?php foreach ($details2 as $detail2): ?>
     <?php foreach ($details3 as $detail3): ?>
         <div id="vehicule-<?php echo $detail['id_vehicule']; ?>" class="vehicule-details">
 <!-- les informations détaillées du vehicule -->
 <h1>Comparaisons des véhicules:</h1>
 
 <table>
     <!--vehicle type -->
     <tr>
                <td><strong>Type Du Véhicule:</strong></td>
                <td><?php echo $this->getTypeLabel($detail1['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail2['type_vehicule']); ?></td>
                <td><?php echo $this->getTypeLabel($detail3['type_vehicule']); ?></td>
     </tr>
     <tr>
     <td><strong>Image du Véhicule :</strong></td>
         <td><img class="vehicule-image" src="../<?php echo $detail1['image_vehicule']; ?>" ></img></td>
         <td><img class="vehicule-image" src="../<?php echo $detail2['image_vehicule']; ?>"></img></td>
         <td><img class="vehicule-image" src="../<?php echo $detail3['image_vehicule']; ?>"></img></td>

     </tr>
     <tr>
     <td><strong>Marque :</strong></td>
         <td><?php echo $detail1['id_marque']; ?></td>
         <td><?php echo $detail2['id_marque']; ?></td>
         <td><?php echo $detail3['id_marque']; ?></td>
     </tr>
     <tr>
     <td><strong>Modele :</strong></td>
         <td><?php echo $detail1['modele']; ?></td>
         <td><?php echo $detail2['modele']; ?></td>
         <td><?php echo $detail3['modele']; ?></td>
     </tr>
     <tr>
     <td><strong>Version :</strong></td>
         <td><?php echo $detail1['version']; ?></td>
         <td><?php echo $detail2['version']; ?></td>
         <td><?php echo $detail3['version']; ?></td>
     </tr>
     <tr>
        <td><strong>Année :</strong></td>
        <td><?php echo $detail1['annee']; ?></td>
        <td><?php echo $detail2['annee']; ?></td>
        <td><?php echo $detail3['annee']; ?></td>
    </tr>
    <tr>
       <td><strong>Dimensions :</strong></td>
        <td><?php echo $detail1['dimensions']; ?></td>
        <td><?php echo $detail2['dimensions']; ?></td>
        <td><?php echo $detail3['dimensions']; ?></td>
    </tr>
    <tr>
        <td><strong>Consommation :</strong></td>
        <td><?php echo $detail1['consommation']; ?></td>
        <td><?php echo $detail2['consommation']; ?></td>
        <td><?php echo $detail3['consommation']; ?></td>
    </tr>
    <tr>
        <td><strong>Moteur :</strong></td>
        <td><?php echo $detail1['moteur']; ?></td>
        <td><?php echo $detail2['moteur']; ?></td>
        <td><?php echo $detail3['moteur']; ?></td>
    </tr>
    <tr>
         <td><strong>Performances :</strong></td>
        <td><?php echo $detail1['performances']; ?></td>
        <td><?php echo $detail2['performances']; ?></td>
        <td><?php echo $detail3['performances']; ?></td>
    </tr>
    <tr>
        <td><strong>Tarif :</strong></td>
        <td><?php echo $detail1['tarif']; ?></td>
        <td><?php echo $detail2['tarif']; ?></td>
        <td><?php echo $detail3['tarif']; ?></td>
    </tr>
      
 </table>
 <!-- fin infos AJOUTERRRRRRRRRR NOTE !!!!! -->
 </div>
   
     <?php endforeach; ?>
     <?php endforeach; ?>
     <?php endforeach; ?>
     
     <?php
   
}

/**** */
public function show_header_comparaison(){//entete de la page comparaison venant de la page d'acceuil ( lors du Clique sur comparer)
    ?>
    <html>
    <head>
       <link href="../styles/accueil.css" rel="stylesheet" type="text/css"/>
       <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
        <script src="../js/Accueil.js"></script>
      
       <title>Tidjelabine</title>
   </head>
   <body>
    <div id="header">
        <div id="logo-container">
            <img src="../images/Logo Tidjelabine2.png" alt="Logo Tidjelabine" id="logo"/>
            
        </div>
        <div id="socialMedia-container">
        <div>
            <?php if (isset($_SESSION['loggedIn'])){/**si le user est connecté */
            if ($_SESSION['loggedIn']==true){
       
            ?> 
      <form method="post"><button id="loginButton" name="logout">Se Deconnecter </button></form>
      </div> 
             <?php
          if (isset($_POST['logout'])){
            $cntr= new SigninController();
            $r=$cntr->Logout();
            }
        }}else{?>
        <!-- si il n est pas connecté-->
          <button id="loginButton" onclick="location.href='/Tidjelabine/SignIn'">Se Connecter</button>
        </div>
   <?php }  ?>
            <a href="https://www.instagram.com/"><img src="../images/instagram.png" alt="Insta logo" class="lien-image"/></a>
            <a href="https://www.instagram.com/"><img src="../images/facebook.png" alt="facebook logo" class="lien-image"/></a>
            <a href="https://www.instagram.com/"><img src="../images/twitter.png" alt="twiiter logo" class="lien-image"/></a>
        </div>
      </div>
     
</body>
</html>
   <?php
    

}
public function show_menu_comparaison($menuItems){
    ?>
    <center>
      </br>
        <div class="menu">
            <ul class="liste">
                <?php foreach ($menuItems as $menuItem): ?>
                    <li><a href="<?php echo $menuItem['lien_element']; ?>"><?php echo $menuItem['nom_element']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </center>
    <?php
}
public function show_Zone2($marques) {
    ?>
      
      <link href="../styles/accueil.css" rel="stylesheet" type="text/css"/>
       <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
       <script src="../js/Accueil.js"></script>

     <div id="zoneContenu">
    <div id="zone2-container">
    <div id="zone2" >
        <!-- Cadre 1 -->
        <div class="cadre" id="cadre1">
            <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form1" class="formulaire">
                <div class="cadre-titre">Véhicule 1  </div></br>
                <label for="marque1">Marque:</label>
                <select name="marque1" id="marque1" onchange="getModele(this.value, 'modele1')" >
                    <!--les options pour les marques -->
                    <option value="">Marque</option>
                    <?php foreach ($marques as $marque): ?>
                    <option value="<?= $marque['id_marque'] ?>"><?= $marque['nom_marque'] ?></option>
                    <?php endforeach; ?>
                
                </select>
                <br>
                <label for="modele1">Modèle:</label>
                <select name="modele1" id="modele1" class="modele" onchange="getVersion(this.value, 'version1')">
                <option value="">Modele</option>  
                <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                </select>
                <!--input type="text" name="modele1" id="modele1" required-->
                <br>
                <label for="version1">Version:</label>

                <select name="version1" id="version1" class="version" onchange="getAnnee(this.value, 'annee1')">
                <option value="">Version</option>    
                <!-- nécessitera une interaction côté client pour que les modeles affichés seront ceux de la marque selectionée seulement-->
                </select>
                <br>
                <label for="annee1">Année:</label>
                
                <select name="annee1" id="annee1" class="annee">
                <option value="">Annee</option>
                 </select>
            </form>
        </div>

        <!-- Cadre 2 -->
        <div class="cadre" id="cadre2">
            <form action="/Tidjelabine/TraitementFormulaire" method="post" id="form2" class="formulaire">
                <div class="cadre-titre">Véhicule 2  </div></br>
                <label for="marque2">Marque:</label>
                <select name="marque2" id="marque2" onchange="getModele(this.value, 'modele2')">
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
                <select name="marque3" id="marque3" onchange="getModele(this.value, 'modele3')">
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
                <select name="marque4" id="marque4" onchange="getModele(this.value, 'modele4')">
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
    <button id="Comparer">Comparer les véhicules</button>

    </div>
    </div>
    <?php
}

/**type vehicule */
private function getTypeLabel($type) {
    switch ($type) {
        case 1:
            return 'Voiture';
        case 2:
            return 'Moto';
        case 3:
            return 'Camion';
        default:
            return 'Inconnu';
    }
}

}
?>
