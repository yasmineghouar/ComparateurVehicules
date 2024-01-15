<?php
require_once ('templateModel.php');
class   MarquesModel extends templateModel {



public function getBigZone1(){//recuperer les logo des principales marques
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT * FROM marques ";//recuperer les marques
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }


    public function get_pcars_by_marque($id_marque){//recuperer les voitures de la marque données
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT *
              FROM vehicules
              WHERE id_marque = :id_marque";

        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect($conn);
        return $result;
    }

    function addMarque($nom_marque, $pays_origine, $siege_social, $annee_creation, $lien_marque, $image_marque) {//ajouter une marque a la table des marques
       // $model = new templateModel();
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO `marques` (nom_marque, pays_origine, siege_social, annee_creation, lien_marque, image_marque) 
        VALUES (:nom_marque, :pays_origine, :siege_social, :annee_creation, :lien_marque, :image_marque)";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':nom_marque', $nom_marque, PDO::PARAM_STR);
        $stmt->bindParam(':pays_origine', $pays_origine, PDO::PARAM_STR);
        $stmt->bindParam(':siege_social', $siege_social, PDO::PARAM_STR);
        $stmt->bindParam(':annee_creation', $annee_creation, PDO::PARAM_INT);
        $stmt->bindParam(':lien_marque', $lien_marque, PDO::PARAM_STR);
        $stmt->bindParam(':image_marque', $image_marque, PDO::PARAM_STR);
        $success = $stmt->execute();
        $this->disconnect($conn);
        return $success;
    }
     /* Fonction qui permet d'inserer un avis de l'utilisateur sur un véhicule donné */
public function insertAvisMarque($id_utilisateur, $id_marque, $commentaire) {
    $conn = $this->connect("root", "", "TDW", "localhost");
    $q = "INSERT INTO avisMarques (id_utilisateur, id_marque, commentaire, statut, nbr_apreciations)
          VALUES (:id_utilisateur, :id_marque, :commentaire, :statut, :nbr_apreciations)";
    
    $statut = 'Non_Valide';
    $nbr_apreciations = 0;

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
    $stmt->bindParam(':nbr_apreciations', $nbr_apreciations, PDO::PARAM_INT);
    
    $stmt->execute();

    $this->disconnect($conn);
}
/**fonction qui permet de voir tous les avis d'un vehicule donné */
public function voir_tous_avis_marque($id_marque) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT avisMarques.id_avis, utilisateurs.nom, utilisateurs.prenom, avisMarques.commentaire, avisMarques.date_avis, avisMarques.nbr_apreciations
          FROM avisMarques
          INNER JOIN utilisateurs ON avisMarques.id_utilisateur = utilisateurs.id_utilisateur
          WHERE avisMarques.id_marque = :id_marque";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $this->disconnect($conn);

    return $result;
}

     /*fonction qui permet d'inserer la note de l'utilisateur sur une marque donnée */
     public function insertNoteMarque($id_utilisateur,$id_marque,$note){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO notesMarques (id_utilisateur, id_marque, note)
          VALUES (:id_utilisateur, :id_marque, :note)";

     $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->execute();

        $this->disconnect($conn);
    }
    /**afficher note de la marque */
    public function getMoyenneNotesMarque($id_marque) {//fct qui permet d'afficher la moyenne des notes d'un véhicule
        $conn = $this->connect("root", "", "TDW", "localhost");
        
        $q = "SELECT AVG(note) AS moyenne_notes FROM notesmarques WHERE id_marque = :id_marque";
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $moyenneNotes = $result['moyenne_notes'];
    
        $this->disconnect($conn);
        
        return $moyenneNotes;
    }
    

}
?>