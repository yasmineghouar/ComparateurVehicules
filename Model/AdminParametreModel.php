<?php
require_once ('templateModel.php');
class   AdminParametreModel extends templateModel {


    /**fonction qui permet la modification d'une info contact  */
    function updateContact($id_contact,$adresse, $email_contact ,$telephone_contact, $description) {
        $conn = $this->connect("root", "", "TDW", "localhost");
       
        $q = "UPDATE `contact_infos` 
              SET adresse = :adresse, 
              email_contact = :email_contact, 
              telephone_contact = :telephone_contact, 
              description = :description 
              WHERE id_contact = :id_contact";
        
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_contact', $id_contact, PDO::PARAM_INT);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':email_contact', $email_contact, PDO::PARAM_STR);
        $stmt->bindParam(':telephone_contact', $telephone_contact, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        
        
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        return $success;
    }
    
    /**fonction qui permet la modification du guide d'achat  */
    function updateGuide($id_guide,$guide) {
        $conn = $this->connect("root", "", "TDW", "localhost");
       
        $q = "UPDATE `guide_infos` 
              SET guide = :guide
              WHERE id_guide = :id_guide";
        
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_guide', $id_guide, PDO::PARAM_INT);
        $stmt->bindParam(':guide', $guide, PDO::PARAM_STR);
        
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        return $success;
    }
    /** Fonction qui supprime une entrée du guide d'achat **/
function delete_guide($id_guide) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "DELETE FROM `guide_infos` WHERE id_guide = :id_guide";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_guide', $id_guide, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
/** Fonction qui ajoute une nouvelle entrée au guide d'achat **/
function add_guide($guide) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "INSERT INTO `guide_infos` (guide) VALUES (:guide)";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':guide', $guide, PDO::PARAM_STR);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
/** Fonction qui permet la modification de lien et d'image_url d'un article */
function update_news_diapo($id_news, $lien, $image_url) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `news` 
          SET lien = :lien, 
              image_url = :image_url
          WHERE id_news = :id_news";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_news', $id_news, PDO::PARAM_INT);
    $stmt->bindParam(':lien', $lien, PDO::PARAM_STR);
    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}

   /**fonctio qui retourne from la bdd les publicités */
   function get_pubs(){
    $conn=$this->connect("root","","TDW","localhost");
    $q= "SELECT * FROM publicites";
     $r= $this->request($conn,$q);
     $this->disconnect($conn);
     return $r;
   }

   /** Fonction qui permet l'ajout d'une nouvelle publicité **/
function add_pub($image_url, $lien) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "INSERT INTO `publicites` (image_url, lien) 
          VALUES (:image_url, :lien)";

    $stmt = $conn->prepare($q);
  
    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
    $stmt->bindParam(':lien', $lien, PDO::PARAM_STR);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
/** Fonction qui permet la modification d'une publicité **/
function update_pub($id_publicite,$image_url, $lien) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `publicites` 
          SET image_url = :image_url,  
              lien = :lien
          WHERE id_publicite = :id_publicite";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_publicite', $id_publicite, PDO::PARAM_INT);
 
    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
   
    $stmt->bindParam(':lien', $lien, PDO::PARAM_STR);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}

/** Fonction qui permet la suppression d'une publicité **/
function delete_pub($id_publicite) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "DELETE FROM `publicites` WHERE id_publicite = :id_publicite";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_publicite', $id_publicite, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}


    
}
?>
