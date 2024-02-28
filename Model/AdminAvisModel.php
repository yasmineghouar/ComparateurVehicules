
<?php
require_once ('templateModel.php');
class AdminAvisModel extends templateModel {//recuperer le guide depuis la bdd

/**fonction qui permet de voir tous les avis d'un vehicule donné */
public function get_all_avis() {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT avis.id_avis,utilisateurs.id_utilisateur,utilisateurs.nom, utilisateurs.prenom, avis.commentaire,avis.statut,vehicules.id_vehicule,vehicules.id_marque,vehicules.modele,vehicules.version,vehicules.annee
          FROM avis
          INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur 
          INNER JOIN vehicules ON avis.id_vehicule = vehicules.id_vehicule ";
          
          $result = $this->request($conn, $q);

          $this->disconnect($conn);
          return $result;
 
}

/**gestion avis */
function deleteAvis($id_avis) {//supprimer un avis
    $conn = $this->connect("root", "", "TDW", "localhost");

    try {
        
        $conn->beginTransaction();
        $q1 = "DELETE FROM `utilisateur_avis` WHERE id_avis = :id_avis";
        $stmt1 = $conn->prepare($q1);
        $stmt1->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $stmt1->execute();

      
        $q2 = "DELETE FROM `avis` WHERE id_avis = :id_avis";
        $stmt2 = $conn->prepare($q2);
        $stmt2->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
        $success = $stmt2->execute();

        if ($success) {
           
            $conn->commit();
            $this->disconnect($conn);
            return true;  
        } else {
           
            $conn->rollBack();
            $this->disconnect($conn);
            return false;
        }
    } catch (PDOException $e) {
     
        $conn->rollBack();
        $this->disconnect($conn);
        return false;
    }
}


function validerAvis($id_avis) {//valider un avis par l'administrateur
    $model = new templateModel();
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `avis` SET statut = 'Valide' WHERE id_avis = :id_avis";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
/**gestion utilisateurs */
function bloquerUtilisateur($id_utilisateur) {
   
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `utilisateurs` SET est_bloque = true WHERE id_utilisateur = :id_utilisateur";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}


}
?>