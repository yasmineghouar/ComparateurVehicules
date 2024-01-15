<?php
require_once ('templateModel.php');
class   AdminNewsModel extends templateModel {


    public function get_all_news(){//fonction qui retoune tous les articles existants dans la bdd
        $conn=$this->connect("root","","TDW","localhost");
       $q= "SELECT * FROM news";
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }
    function deleteNews($id_news) {//supprimer un article news de la bdd
        $conn=$this->connect("root","","TDW","localhost");
        
        $q = "DELETE FROM `news` WHERE id_news = :id_news";
        
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_news', $id_news, PDO::PARAM_INT);
        
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        return $success;
    }
    /**fonction qui permet d'ajouter un article news a la bdd */
    function addNews($titre, $image_url, $texte, $lien, $paragraphes, $image_url_secondaire, $image_url_troisieme) {
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "INSERT INTO `news` (titre, image_url, texte, lien, paragraphes, image_url_secondaire, image_url_troisieme)
              VALUES (:titre, :image_url, :texte, :lien, :paragraphes, :image_url_secondaire, :image_url_troisieme)";
        
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->bindParam(':texte', $texte, PDO::PARAM_STR);
        $stmt->bindParam(':lien', $lien, PDO::PARAM_STR);
        $stmt->bindParam(':paragraphes', $paragraphes, PDO::PARAM_STR);
        $stmt->bindParam(':image_url_secondaire', $image_url_secondaire, PDO::PARAM_STR);
        $stmt->bindParam(':image_url_troisieme', $image_url_troisieme, PDO::PARAM_STR);
        
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        return $success;
    }
    /**fonction qui permet la modification d'un article  */
    function updateNews($id_news, $titre, $image_url, $texte, $lien, $paragraphes, $image_url_secondaire, $image_url_troisieme) {
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "UPDATE `news` 
              SET titre = :titre, 
                  image_url = :image_url, 
                  texte = :texte, 
                  lien = :lien, 
                  paragraphes = :paragraphes, 
                  image_url_secondaire = :image_url_secondaire, 
                  image_url_troisieme = :image_url_troisieme 
              WHERE id_news = :id_news";
        
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_news', $id_news, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->bindParam(':texte', $texte, PDO::PARAM_STR);
        $stmt->bindParam(':lien', $lien, PDO::PARAM_STR);
        $stmt->bindParam(':paragraphes', $paragraphes, PDO::PARAM_STR);
        $stmt->bindParam(':image_url_secondaire', $image_url_secondaire, PDO::PARAM_STR);
        $stmt->bindParam(':image_url_troisieme', $image_url_troisieme, PDO::PARAM_STR);
        
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        return $success;
    }
    
    

   
    
}
?>
