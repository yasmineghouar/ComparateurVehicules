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
    


    public function showZone2() {
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
}