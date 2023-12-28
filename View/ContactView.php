<?php
require_once ('template.php');

class ContactView extends template{
 

    public function index(){

       $this->main();
         /**afficher les informations du contact */
       $this->show_contactInfo();


    }
    
   
    public function show_contactInfo()
    {
        $contactController = new ContactController();

      
        $contactinfo = $contactController->ContactInfos();

        ?>
        <link rel="stylesheet" type="text/css" href="styles/contact.css">
        <div id="contact-details-container">
            <h2>Contactez-nous</h2>
           

            <?php
            foreach ($contactinfo as $row) {// Affichezles informations de contact de la même manière
                echo "<p> " . $row['description'] . "</p>";
                echo "<p>Téléphone    :" . $row['telephone_contact'] . "</p>";
                echo "<p>Email        :" . $row['email_contact'] . "</p>";
                echo "<p>Adresse      :" . $row['adresse'] . "</p>"; 

            }
            ?>
        </div>
        <?php
    }

}
?>
