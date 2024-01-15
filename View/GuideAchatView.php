<?php
require_once ('template.php');

class GuideAchatView extends template{


    public function index(){

        $this->main();
          /**afficher le guide */
        $this->show_guide();
        $this->show_footer();
        

     }

     public function show_guide()
     {
         $guideController = new GuideAchatController();
 
       
         $guideinfo = $guideController->getGuideAchat();
 
         ?>
         <link rel="stylesheet" type="text/css" href="styles/contact.css">
         <div id="contact-details-container">
             <h2>Guide d'Achat :  </h2>
            
 
             <?php
            foreach ($guideinfo as $row) {// Affichezles informations de contact de la même manière
                echo "<div style='margin-bottom: 15px; padding: 10px; background-color: #fff; border: 1px solid #ddd; border-radius: 3px;'>" . $row['guide'] . "</div>";
                echo "<hr style='margin: 15px 0; border: none; height: 1px; background-color: #ddd;'>";
            }
            ?>
        </div>
         <?php
     }
}
?>
