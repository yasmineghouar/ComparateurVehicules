<?php
require_once ('template.php');

class AdminAccueilView extends template{


    public function index(){

        $this->main();
          $this->gestion();
          $this->show_footer();
          

     }

     public function gestion(){
        ?>
        <link rel="stylesheet" type="text/css" href="styles/gestion.css"></link>
        <div style="height: 50px;"></div>
        <div class="category-header1" onclick="location.href='/Tidjelabine/AdminVehicule'">
           <div class="category1-title1">Gestion de Véhicules</div>   
           <img src="images/gestionAuto.jpg" alt="">
         </div>
         <div class="category-header1" onclick="location.href='/Tidjelabine/AdminAvis'">
           <div class="category1-title1">Gestion des Avis</div>   
           <img src="images/avisManage.jpg" alt="">
         </div>
         <div class="category-header1" onclick="location.href='/Tidjelabine/AdminNews'">
           <div class="category1-title1">Gestion des News</div>   
           <img src="images/newsManage.jpg" alt="">
         </div>
         <div class="category-header1" onclick="location.href='/Tidjelabine/AdminUser'">
           <div class="category1-title1">Gestion des Utilisateurs</div>   
           <img src="images/users.jpg" alt="">
         </div>
         <div class="category-header1" onclick="location.href='/Tidjelabine/AdminParametres'">
           <div class="category1-title1">Paramètres</div>   
           <img src="images/settings.jpg" alt="">
         </div>
        <?php
     }
}
?>
