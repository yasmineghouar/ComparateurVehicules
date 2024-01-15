<?php
require_once ('templateModel.php');
class ComparateurModel extends templateModel {

    
    public function get_vehicule_details($id_marque, $modele, $version, $annee) {
        if ($id_marque === "" && $modele === "" && $version === "" && $annee === "") {
            return null;
        }
    
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT *
              FROM vehicules
              WHERE id_marque = :id_marque
                AND modele = :modele
                AND version = :version
                AND annee = :annee";
    
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
        $stmt->bindParam(':version', $version, PDO::PARAM_STR);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->execute();
        
        // Récupérer tous les résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $this->disconnect($conn);
        return $result;
    }


    public function insertComparaison($car1details,$car2details){//inserer une comparaison pour pouvoir savoir les quelles sont plus populaires.
        $conn = $this->connect("root", "", "TDW", "localhost");
        foreach ($car1details as $detail1):
            foreach ($car2details as $detail2):
                $id_vehicule1=$detail1['id_vehicule'];
                $id_vehicule2=$detail2['id_vehicule'];
            endforeach;
        endforeach;
      // Vérifier si la comparaison entre les 2V existe déjà dans la table
    $q = "SELECT id_comparaison, nbr_cliques FROM comparaisons
    WHERE (id_vehicule_1 = :id1 AND id_vehicule_2 = :id2)
       OR (id_vehicule_1 = :id2 AND id_vehicule_2 = :id1)";
        //Suppression de la ligne $r->fetchColumn() car une requête d'insertion ne retourne pas de colonne spécifique.
        //uutilisation de requete préparée avec des paramètres liés (bindParam) pour éviter l'injection SQL et améliorer la sécurité.
        $stmt = $conn->prepare($q);


        // Liaison des valeurs avec les paramètres de la requête préparée
        $stmt->bindParam(':id1', $id_vehicule1, PDO::PARAM_INT);
        $stmt->bindParam(':id2', $id_vehicule2, PDO::PARAM_INT);

          // Exécution de la requête préparée
         $stmt->execute();
         $existingComparison = $stmt->fetch(PDO::FETCH_ASSOC);
         
          // Si la comparaison existe déjà, incrémenter le nombre de clics
    if ($existingComparison) {
        $id_comparaison = $existingComparison['id_comparaison'];
        $nbr_cliques = $existingComparison['nbr_cliques'] + 1;

        $updateQuery = "UPDATE comparaisons SET nbr_cliques = :nbr_cliques WHERE id_comparaison = :id_comparaison";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':nbr_cliques', $nbr_cliques, PDO::PARAM_INT);
        $updateStmt->bindParam(':id_comparaison', $id_comparaison, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
         
         // Si la comparaison n'existe pas, insérer une nouvelle entrée dans la table
        $insertQuery = "INSERT INTO comparaisons (id_vehicule_1, id_vehicule_2, nbr_cliques)
        VALUES (:id_vehicule1, :id_vehicule2, 1)";
$insertStmt = $conn->prepare($insertQuery);
$insertStmt->bindParam(':id_vehicule1', $id_vehicule1, PDO::PARAM_INT);
$insertStmt->bindParam(':id_vehicule2', $id_vehicule2, PDO::PARAM_INT);
$insertStmt->execute();
         
          
    }

    $this->disconnect($conn);
} 
   


}
?>