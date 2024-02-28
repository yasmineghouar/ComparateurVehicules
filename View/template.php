<?php

Class template{

    public function main(){
        echo '<html>';
        $this->Head_page();
        echo '<body>';

        echo '<div id="header">';
        $this->afficherLogo();
        $this->show_socialMedia();
        echo '</div>';
        echo'</br>';
        echo '<div id="menu-containerr">';
        $this->show_menu();
        echo '</div>';
        
        echo '</body>';
        echo '</html>';

    }
     
    public function Head_page() {
        ?>
         <head>
            <link href="styles/accueil.css" rel="stylesheet" type="text/css"/>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
           
             <script src="js/Accueil.js"></script>
           
            <title>Tidjelabine</title>
        </head>
        <?php
    }

    public function afficherLogo() {
        ?>
        <div id="logo-container">
            <img src="images/Logo Tidjelabine2.png" alt="Logo Tidjelabine" id="logo"/>
            
        </div>
        <?php
    }


   
    public function show_socialMedia() {
        ?>
        <div id="socialMedia-container">
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
        <a style="cursor:pointer; margin-right:10px;" href="/Tidjelabine/UserProfil"><img src="images/profil.png" width="25" height="25"></a>
        <?php endif; ?>
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
           
            <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Insta logo" class="lien-image"/></a>
            <a href="https://www.instagram.com/"><img src="images/facebook.png" alt="facebook logo" class="lien-image"/></a>
            <a href="https://www.instagram.com/"><img src="images/twitter.png" alt="twiiter logo" class="lien-image"/></a>
        </div>
        
        <?php
    }
    
    public function show_menu() {
        ?>
         <?php
        $cf =  new AccueilController();
        $menuItems = $cf->menu();//récupèrer les données du controleur(les elements du menu)
          ?>
        <center>
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
    


    public function showZone2() {//fct quiaffich eles 4 cadres de comparaison
        ?>
          
         <?php
        $cf =  new AccueilController();
        $marques = $cf->marques();//récupèrer les données du controleur(les marques principales)
         ?>
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
    public function show_footer() {
        ?>
         <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
           
           <script src="js/Accueil.js"></script>
        <?php
        $cf = new AccueilController();
        $menuItems = $cf->menu(); // Récupérer les données du contrôleur (les éléments du menu)
        ?>
        <center>
            <div class="footer-menu">
                <ul class="horizontal-list">
                    <?php foreach ($menuItems as $menuItem): ?>
                        <li><a href="<?php echo $menuItem['lien_element']; ?>"><?php echo $menuItem['nom_element']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </center>
        <?php
    }
    
    public function show2PopularComparaison($mostPopularComparison,$secondMostPopularComparison) {
        ?>
        <?php
        //mostPopularComparison contient vehicule1vehicule 2
        //secondMostPopularComparison contient vehicule 3 vehicule 4 
                $cf =  new AccueilController();
                $veh_cf = new VehiculeController();
                //$mostPopularComparison = $cf->getMostPopularComparison();/*recuperer les id des vehciules les plus comparés entre eux */
                //$secondMostPopularComparison = $cf->getSecondMostPopularComparison();/*recuperer les id des vehciules les plus comparés entre eux 2e position*/
                
                // Accéder aux résultats
               $id_vehicule_1 = $mostPopularComparison['id_vehicule_1'];
               $id_vehicule_2 = $mostPopularComparison['id_vehicule_2'];
    
               $marque_vehicule_1 = $veh_cf->get_marque_vehicule($id_vehicule_1);//récupèrer le nom de la marque
               $nom_marque_vehicule_1= $marque_vehicule_1[0]['nom_marque'];
               $marque_vehicule_2 = $veh_cf->get_marque_vehicule($id_vehicule_2);//récupèrer le nom de la marque
               $nom_marque_vehicule_2= $marque_vehicule_2[0]['nom_marque'];
    
               $details1=$cf->cars_details($id_vehicule_1);
               $details2=$cf->cars_details($id_vehicule_2);
               //2e position
               $id_vehicule_3 = $secondMostPopularComparison['id_vehicule_1'];
               $id_vehicule_4 = $secondMostPopularComparison['id_vehicule_2'];
    
               $marque_vehicule_3 = $veh_cf->get_marque_vehicule($id_vehicule_3);//récupèrer le nom de la marque
               $nom_marque_vehicule_3= $marque_vehicule_1[0]['nom_marque'];
               $marque_vehicule_4 = $veh_cf->get_marque_vehicule($id_vehicule_4);//récupèrer le nom de la marque
               $nom_marque_vehicule_4= $marque_vehicule_2[0]['nom_marque'];
    
               $details3=$cf->cars_details($id_vehicule_3);
               $details4=$cf->cars_details($id_vehicule_4);
        
        ?>
        <link rel="stylesheet" type="text/css" href="styles/accueil.css"></link>
        <!--script src="js/marques.js"></script-->
        </br></br></br></br>
         <?php foreach ($details1 as $detail1): ?>
         <?php foreach ($details2 as $detail2): ?>
            <?php foreach ($details3 as $detail3): ?>
         <?php foreach ($details4 as $detail4): ?>
            <form id="hiddenForm3" action="/Tidjelabine/TraitementListe" method="post" style="display: none;">
            <input id="idVehiculeClique" type="hidden" name="vehiculeId"  >
            </form>
    
            <script>
             function submitForm(idVehiculeClique) {
               //modifier value de input pour envoyer en POST au VEHICULECONTROLLER METHOD traitementformulaire(); pr aficher les details vehicule cliqué
              $('#idVehiculeClique').val(idVehiculeClique);
              // recuperer le formulaire en haut par son id
              var form = document.getElementById('hiddenForm3');
               // Soumettre le formulaire
             form.submit();
               }
            </script>
             <div  class="vehicule-details">
     <!-- les informations détaillées du vehicule -->
     <h1>Les comparaisons les plus populaires ! :</h1>
     <div class="table-container">
     <table>
      
         <tr>
       
             <td><a href="javascript:void(0);" onclick="submitForm(<?php echo $detail1['id_vehicule']; ?>)"><img id="vehicule-image" src="<?php echo $detail1['image_vehicule']; ?>" data-value="<?php echo $detail1['id_vehicule']; ?>" style="max-width: 100%; width: 600px;height:300px ; margin:0 auto"></img></a></td>
             <td><a href="javascript:void(0);" onclick="submitForm(<?php echo $detail2['id_vehicule']; ?>)"><img id="vehicule-image" src="<?php echo $detail2['image_vehicule']; ?>" data-value="<?php echo $detail2['id_vehicule']; ?>" style="max-width: 100%; width: 600px;height:300px ; margin:0 auto"></img></a></td>
            
         </tr>
         <tr>
         <td><?php echo $nom_marque_vehicule_1; ?> , <?php echo $detail1['modele']; ?> , <?php echo $detail1['version']; ?> , <?php echo $detail1['annee']; ?> .</td><td><?php echo $nom_marque_vehicule_2; ?> , <?php echo $detail2['modele']; ?> , <?php echo $detail2['version']; ?> , <?php echo $detail2['annee']; ?> </td>
         </tr>
         
          
     </table>
     </div>
     <form action="/Tidjelabine/Controller/TraitementListe.php" method="post"><input name="id_vehicule_1" value="<?php echo $id_vehicule_1; ?>" hidden ><input name="id_vehicule_2" value="<?php echo $id_vehicule_2; ?>" hidden ><button style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #c5a173; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="this.form.submit()">Plus de détails</button></form>
    
     <!--2e comparaison la plus populaire--->
     <div class="table-container">
     <table>
     <tr>
         
             <td><a href="javascript:void(0);" onclick="submitForm(<?php echo $detail3['id_vehicule']; ?>)"><img id="vehicule-image" src="<?php echo $detail3['image_vehicule']; ?>" data-value="<?php echo $detail3['id_vehicule']; ?>" style="max-width: 100%; width: 600px;height:300px ; margin:0 auto"></img></a></td>
             <td><a href="javascript:void(0);" onclick="submitForm(<?php echo $detail4['id_vehicule']; ?>)"><img id="vehicule-image" src="<?php echo $detail4['image_vehicule']; ?>" data-value="<?php echo $detail4['id_vehicule']; ?>" style="max-width: 100%; width: 600px;height:300px ; margin:0 auto;"></img></a></td>
            
         </tr>
         <tr>
         <td><?php echo $nom_marque_vehicule_3; ?> , <?php echo $detail3['modele']; ?> , <?php echo $detail3['version']; ?>, <?php echo $detail3['annee']; ?>.</td><td><?php echo $nom_marque_vehicule_4; ?> , <?php echo $detail4['modele']; ?> , <?php echo $detail4['version']; ?> , <?php echo $detail4['annee']; ?> </td>
         </tr>
         
     </table>
     
     </div>
     <form action="/Tidjelabine/Controller/TraitementListe.php" method="post"><input name="id_vehicule_1" value="<?php echo $id_vehicule_3; ?>" hidden ><input name="id_vehicule_2" value="<?php echo $id_vehicule_4; ?>" hidden ><button style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #c5a173; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="this.form.submit()">Plus de détails</button></form>
    
     <!-- fin infos AJOUTERRRRRRRRRR NOTE !!!!! -->
     </div>
       
         <?php endforeach; ?>
         <?php endforeach; ?>
         <?php endforeach; ?>
         <?php endforeach; ?>
       
         
         <?php
    }
    
}