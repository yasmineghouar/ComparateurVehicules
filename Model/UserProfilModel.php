<?php
require_once ('templateModel.php');
class UserProfilModel extends templateModel {//recuperer le guide depuis la bdd


public function getUserNomPrenom($id_utilisateur){//retounr nom et prenom du user pour l afficher dans profile page
       
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        
        $q = "SELECT nom, prenom FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = $conn->prepare($q);
    
        // Liaison du paramètre avec la requete préparée
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
    
        
        $result = $stmt->fetchAll();
    
        
        $this->disconnect($conn);
    
        
        return $result;
    }
    public function getUserInfo($id_utilisateur){//retounr infos du user pour l afficher dans profile page
       
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        
        $q = "SELECT date_naissance, email, sexe FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = $conn->prepare($q);
    
        // Liaison du paramètre avec la requete préparée
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
    
        
        $result = $stmt->fetchAll();
    
        
        $this->disconnect($conn);
    
        
        return $result;
    }

    function getFavorisDetails($id_utilisateur) {//retounr les vehicules favoris du user $id_utilisateur
        $model = new templateModel();
        $conn = $model->connect("root", "", "TDW", "localhost");
    
        $q = "SELECT v.*
              FROM favoris f
              INNER JOIN vehicules v ON f.id_vehicule = v.id_vehicule
              WHERE f.id_utilisateur = :id_utilisateur";
    
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
    
        $favorisDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $model->disconnect($conn);
    
        return $favorisDetails;
    }
    

}
?>