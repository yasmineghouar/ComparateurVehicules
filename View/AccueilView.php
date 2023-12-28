<?php
//require_once ('template.php');
   //récupèrer les données du controleur et les afficher
  class AccueilView {
      
   
    public function Head_page() {
        ?>
        <head>
            <link href="styles/accueil.css" rel="stylesheet" type="text/css"/>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
           
             <!-- Inclure le fichier accueil.js -->
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

     public function show_diaporama(){
        ?>
        <?php
         $cf =  new AccueilController();
        $images = $cf->diaporama();//récupèrer les données du controleur
        ?>
        <center>
 
     <div id="diaporama-container" class="Diapo-container">
     <?php foreach ($images as $index => $image): ?>
        <a href="<?php echo $image['lien']; ?>" target="_blank">
            <img src="<?php echo $image['image_url']; ?>" alt="Diaporama Image" class="diaporama-item" <?php echo $index === 0 ? 'style="display: block;"' : ''; ?> />
        </a>
     <?php endforeach; ?>
     </div>

  
        </center>
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

        public function show_footer() {
            ?>
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
        
    
        public function showZone1() {
            ?>

         <?php
            $cf =  new AccueilController();
            $marques = $cf->zone1();//récupèrer les données du controleur(les marques principales)
        ?>
            <div id="zone1" class="zone1-container">
                <?php foreach ($marques as $marque): ?>
                    <a href="<?php echo $marque['lien_marque']; ?>">
                        <img src="<?php echo $marque['image_marque']; ?>" alt="<?php echo $marque['nom_marque']; ?>">
                    </a>
                <?php endforeach; ?>
            </div>
            <?php
        }

        
        
        public function showZone2() {
            ?>
             <?php
            $cf =  new AccueilController();
            $marques = $cf->marques();//récupèrer les données du controleur(les marques principales)
           
             ?>
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
            <?php
        }
        
        
        public function showZone3() {
            ?>
            <div id="zone3" class="zone3-container">
                <button id="buttonZone3" onclick="window.location.href='/Tidjelabine/GuideAchat'">Avez-vous besoin de l'aide? le Guide d'achat est là pour vous!</button>
            </div>
            <?php
        }

        

     public function index(){
        echo '<html>';
        $this->Head_page();
        echo '<body>';

        echo '<div id="header">';
        $this->afficherLogo();
        
        $this->show_socialMedia();
        echo '</div>';
       /* echo '<div id="login-container">';
echo '<button id="login-button" onclick="window.location.href=\'/Tidjelabine/Login\'">Login</button>';
*/
        $this->show_diaporama();
        $this->show_menu();
        echo '<div id="zoneContenu">';
        $this->showZone1();
        $this->showZone2();
        $this->showZone3();
        echo '</div>';
        $this->show_footer();
        echo '</body>';
        echo '</html>';
     }


    /*
    public function show_title_page(){
        //echo '<br><br>';
        echo '<h1 align="center">         Smartphones </h1>';
    }
      
    public function show_diaporama(){
       echo'<center>';

       echo'<div class="container">';
       echo'<img src="xia.jpg" alt="Xiaomi Redmi Note12">';
       echo'<img src="composition-elegante-du-smartphone (1).jpg" alt="Apple iPhone 15 plus">';
       echo'<img src="samsung.jpg" alt="Samsung Galaxy 21Ultra">';
       echo'<img src="huwawei.jpg" alt="Huawei P30 Lite">';
       echo'</div>';
 
       echo'</center>';

    }

    public function show_menu(){
        
        echo'<center>';
        echo'<div class="menu">';
        echo'<ul class="liste" >';
        echo'<li><a href="http://www.apple.fr">Accueil</a></li>';
        echo'<li class="marque">Marque'; 
        echo'<ul class="marque-contenu">';
        echo'<li><a href="http://www.apple.fr">Apple</a></li>';
        echo'<li><a href="http://www.samsung.fr">Samsung</a></li>';
        echo'<li><a href="http://www.oppo.com">Oppo</a></li>';
        echo'</ul>';
        echo'</li>';
        echo'<li><a href="http://www.apple.fr">News</a></li>';
        echo'</ul>';
        echo'</div>';
        echo'</center>';

    }

    public function show_video(){
       echo' <center>';
       echo'<video class="video" src="./Introducing iPhone 15 Pro _ Apple.mp4" width="700" height="400" preload="auto" controls autoplay>';
       echo'<p>Les nouveaux smartphones</p>';
       echo'</video>';
       echo'</center>'; 
    }
     
    public function show_footer(){
        echo'<p>';
        echo'<a href="mailto:ky_ghouar@esi.dz"> Contactez nous par email</a>';
        echo'</p>';
    }
     
    public function Body_page(){
        echo '<body>';
        echo'<center>';
        $this->show_title_page();
        $this->show_diaporama();
        $this->show_menu();
        echo '</br><br></br></br>';
        $this->show_video();
        $this->show_Table_view();
        $this->show_footer();
        echo '<br/><br/><br/><br/>';
        echo'</body>';

    }
   
    public function Show_Website(){
        echo'<html>';
        $this->Head_page();
        $this->Body_page();
        echo'</html>';

    }


*/




  }

?>