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
    

    
   


}
?>