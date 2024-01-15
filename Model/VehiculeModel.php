<?php
require_once ('templateModel.php');
class   VehiculeModel extends templateModel {


    public function get_cars_details($id_vehicule){//recuperer les details de la voiture avec l'id donné
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT *
              FROM vehicules
              WHERE id_vehicule = :id_vehicule";

        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect($conn);
        return $result;
    }

    public function get_all_cars(){//recuperer toute la table vehicule
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT * FROM vehicules ";//recuperer les vehicules
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;
    }

    public function get_marque_vehicule($id_vehicule){
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        // Utilisation d'une jointure pour récupérer la marque du véhicule
        $q = "SELECT m.nom_marque
              FROM vehicules v
              JOIN marques m ON v.id_marque = m.id_marque
              WHERE v.id_vehicule = $id_vehicule";
    
        $res = $this->request($conn, $q);
        
        $this->disconnect($conn);
    
      return $res;
        }
    
    


       /*fonction qui permet d'inserer la note de l'utilisateur sur un vehicule donnée */
    public function insertNote($id_utilisateur,$id_vehicule,$note){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO notes (id_utilisateur, id_vehicule, note)
          VALUES (:id_utilisateur, :id_vehicule, :note)";

     $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->execute();

        $this->disconnect($conn);
    }
    public function getMoyenneNotesVehicule($id_vehicule) {//fct qui permet d'afficher la moyenne des notes d'un véhicule
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT AVG(note) AS moyenne_notes FROM notes WHERE id_vehicule = :id_vehicule";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $moyenneNotes = $result['moyenne_notes'];
    
        $this->disconnect($conn);
        
        return $moyenneNotes;
    }

    /* Fonction qui permet d'inserer un avis de l'utilisateur sur un véhicule donné */
public function insertAvis($id_utilisateur, $id_vehicule, $commentaire) {
    $conn = $this->connect("root", "", "TDW", "localhost");
    $q = "INSERT INTO avis (id_utilisateur, id_vehicule, commentaire, statut, nbr_apreciations)
          VALUES (:id_utilisateur, :id_vehicule, :commentaire, :statut, :nbr_apreciations)";
    
    $statut = 'Non_Valide';
    $nbr_apreciations = 0;

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
    $stmt->bindParam(':nbr_apreciations', $nbr_apreciations, PDO::PARAM_INT);
    
    $stmt->execute();

    $this->disconnect($conn);
}
/**fonction qui permet de voir tous les avis d'un vehicule donné */
public function voir_tous_avis($id_vehicule) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT avis.id_avis, utilisateurs.nom, utilisateurs.prenom, avis.commentaire, avis.date_avis, avis.nbr_apreciations
          FROM avis
          INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur
          WHERE avis.id_vehicule = :id_vehicule";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $this->disconnect($conn);

    return $result;
}
/**cette fonction permet de retourner les 3 avis les plus appreciers sur le vehicule */
public function troisMeilleursAvis($id_vehicule) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT avis.id_avis, utilisateurs.nom, utilisateurs.prenom, avis.commentaire, avis.date_avis, avis.nbr_apreciations
          FROM avis
          INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur
          WHERE avis.id_vehicule = :id_vehicule
          ORDER BY avis.nbr_apreciations DESC
          LIMIT 3";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $this->disconnect($conn);

    return $result;
}
//afficher les avis paginés
public function getAdditionalReviews($id_vehicule, $offset, $limit) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT * FROM avis
    INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur
    WHERE avis.id_vehicule = :id_vehicule LIMIT :limit OFFSET :offset";
    
    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $this->disconnect($conn);

    return $result;
}
/***fonction qui permet d ajouter au favoris une voiture */
function ajouter_favoris($id_vehicule, $id_utilisateur){
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
    
    $q = "INSERT INTO `favoris` (id_utilisateur, id_vehicule) VALUES (:id_utilisateur, :id_vehicule)";
    $stmt = $conn->prepare($q);
    
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    
    $success = $stmt->execute();
    
    $model->disconnect($conn);
    
    return $success;
}

/** fonction qui retourne la comparaison la plus populaire d'un vehicule donné */
public function getMostPopularComparisonForVehicle($id_vehicule) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    // Sélectionner l'ID de l'autre véhicule dans la comparaison
    $query = "SELECT id_vehicule_1, id_vehicule_2
              FROM comparaisons
              WHERE id_vehicule_1 = :id_vehicule OR id_vehicule_2 = :id_vehicule
              ORDER BY nbr_cliques DESC
              LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les résultats
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermer la connexion
    $conn = null;

    return $result;
}

/** fonction qui retourne la comparaison la 2e plus populaire d'un vehicule donné */
public function getSecondPopularComparisonForVehicle($id_vehicule) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    // Sélectionner l'ID de l'autre véhicule dans la comparaison
    $query = "SELECT id_vehicule_1, id_vehicule_2
              FROM comparaisons
              WHERE id_vehicule_1 = :id_vehicule OR id_vehicule_2 = :id_vehicule
              ORDER BY nbr_cliques DESC
              LIMIT 1 OFFSET 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les résultats
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermer la connexion
    $conn = null;

    return $result;
}




}
?>
