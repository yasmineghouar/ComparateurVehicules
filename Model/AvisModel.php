<?php
require_once ('templateModel.php');
class AvisModel extends templateModel {//recuperer le guide depuis la bdd

    public function apprecierAvis($id_avis) { //fonction qui permet d'apprecier un avis
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q ="UPDATE avis SET nbr_apreciations = nbr_apreciations + 1 WHERE id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $success = $stmt->execute();
        $this->disconnect($conn);
        return $success;
    }
    public function utilisateurAvisExists($id_utilisateur, $id_avis) {//fonction qui permet de verifier si user a déja liker ce commentaire ou pas
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT COUNT(*) FROM utilisateur_avis WHERE id_utilisateur = :id_utilisateur AND id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
    
        $this->disconnect($conn);
    
        return ($count > 0); // True si l'utilisateur avec l'ID d avis existe deja, sinon False
    }
    /**cette fct enregistre l'utilisateur et l'id de la vis liké  pour ne pas qu'il like 2 fois le meme avis*/
    public function enregistrerLike($id_utilisateur,$id_avis){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO utilisateur_avis (id_utilisateur, id_avis) VALUES (:id_utilisateur, :id_avis)";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        
        return $success;
    }
    
    public function apprecierAvisMarque($id_avis) { //fonction qui permet d'apprecier un avis sur une marque
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q ="UPDATE avisMarques SET nbr_apreciations = nbr_apreciations + 1 WHERE id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $success = $stmt->execute();
        $this->disconnect($conn);
        return $success;
    }
    public function utilisateurAvisMarqueExists($id_utilisateur, $id_avis) {//fonction qui permet de verifier si user a déja liker ce commentaire Marque ou pas
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT COUNT(*) FROM utilisateur_avisMarques WHERE id_utilisateur = :id_utilisateur AND id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
    
        $this->disconnect($conn);
    
        return ($count > 0); // True si l'utilisateur avec l'ID d avis existe deja, sinon False
    }
     /**cette fct enregistre l'utilisateur et l'id de l avis de marque liké  pour ne pas qu'il like 2 fois le meme avis*/
     public function enregistrerLikeMarque($id_utilisateur,$id_avis){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO utilisateur_avisMarques (id_utilisateur, id_avis) VALUES (:id_utilisateur, :id_avis)";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $success = $stmt->execute();
        
        $this->disconnect($conn);
        
        return $success;
    }
    
    
    public function getNombreAppreciationsAvisMrk($id_avis) {//fct qui retourne le nombre d'appreciation d'un commentaire de MARQUE elle a comme id ($id_avis)
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT nbr_apreciations FROM avisMarques WHERE id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $stmt->execute();
    
        $nombreAppreciations = $stmt->fetchColumn();
    
        $this->disconnect($conn);
        
        return $nombreAppreciations;
    }
    public function getNbrLikeAvis($id_avis) {//fct qui retourne le nombre d'appreciation d'un commentaire de voiture elle a comme id ($id_avis)
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT nbr_apreciations FROM avis WHERE id_avis = :id_avis";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $stmt->execute();
    
        $nombreAppreciations = $stmt->fetchColumn();
    
        $this->disconnect($conn);
        
        return $nombreAppreciations;
    }

        
}
?>