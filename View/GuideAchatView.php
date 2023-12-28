<?php
require_once ('template.php');

class GuideAchatView extends template{


    public function index(){

        $this->main();
          /**afficher le guide */
        $this->show_guide();
        

     }

     public function show_guide()
     {
         $guideController = new GuideAchatController();
 
       
         $guideinfo = $guideController->GuideInfos();
 
         ?>
         <link rel="stylesheet" type="text/css" href="styles/contact.css">
         <div id="contact-details-container">
             <h2>Guide d'Achat </h2>
            
 
             <?php
            foreach ($guideinfo as $row) {// Affichezles informations de contact de la même manière
                echo "<div> " . $row['guide'] . "</div>";
               

            }
            ?>
         </div>
         <?php
     }
}
?>
