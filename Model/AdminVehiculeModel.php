<?php
require_once ('templateModel.php');
class AdminVehiculeModel extends templateModel {


    function deleteMarque($id_marque){
        
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        try {
            $conn->beginTransaction();
    
            // Supprimer les enregistrements liés dans la table 'avisMarques'
            $q1 = "DELETE FROM avisMarques WHERE id_marque = :id_marque";
            $stmt1 = $conn->prepare($q1);
            $stmt1->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
            $stmt1->execute();

             // Supprimer les enregistrements liés dans la table 'avis'
             $q2 = "DELETE FROM avis WHERE id_vehicule IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)";
             $stmt2 = $conn->prepare($q2);
              $stmt2->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
              $stmt2->execute();
 // Supprimer l'enregistrement dans la table 'notes'
              $q3 = "DELETE FROM notesMarques WHERE id_marque = :id_marque";
             $stmt3 = $conn->prepare($q3);
             $stmt3->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
              $stmt3->execute();
               // Supprimer les enregistrements liés dans la table 'comparaisons'
        $q4 = "DELETE FROM comparaisons WHERE id_vehicule_1 IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)
        OR id_vehicule_2 IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)
        OR id_vehicule_3 IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)
        OR id_vehicule_4 IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)";
         $stmt4 = $conn->prepare($q4);
         $stmt4->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
         $stmt4->execute();
       // Supprimer les enregistrements liés dans la table 'favoris'
           $q6 = "DELETE FROM favoris WHERE id_vehicule IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)";
            $stmt6 = $conn->prepare($q6);
            $stmt6->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
             $stmt6->execute();

            // Supprimer les enregistrements liés dans la table 'notes'
          $q7 = "DELETE FROM notes WHERE id_vehicule IN (SELECT id_vehicule FROM vehicules WHERE id_marque = :id_marque)";
          $stmt7 = $conn->prepare($q7);
          $stmt7->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
           $stmt7->execute();
             // Supprimer les enregistrements liés dans la table 'vehicules'
             $q5 = "DELETE FROM vehicules WHERE id_marque = :id_marque";
            $stmt5 = $conn->prepare($q5);
             $stmt5->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
            $stmt5->execute();

            // Supprimer la marque dans la table 'marques'
            $q6 = "DELETE FROM marques WHERE id_marque = :id_marque";
            $stmt6 = $conn->prepare($q6);
            $stmt6->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
            $stmt6->execute();
    
            $conn->commit();
            $this->disconnect($conn);
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, annuler les modifications
            $conn->rollBack();
            $this->disconnect($conn);
            return false;
        }
    }
    

    function deleteVehicule($id_vehicule){//supprimer un vehicule de la bdd
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        try {
            $conn->beginTransaction();
    
            // Supprimer les enregistrements liés dans la table 'avis'
            $q1 = "DELETE FROM avis WHERE id_vehicule = :id_vehicule";
            $stmt1 = $conn->prepare($q1);
            $stmt1->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $stmt1->execute();
    
            // Supprimer les enregistrements liés dans la table 'comparaisons'
            $q2 = "DELETE FROM comparaisons WHERE 
                id_vehicule_1 = :id_vehicule OR 
                id_vehicule_2 = :id_vehicule OR 
                id_vehicule_3 = :id_vehicule OR 
                id_vehicule_4 = :id_vehicule";
            $stmt2 = $conn->prepare($q2);
            $stmt2->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $stmt2->execute();
    
            // Supprimer l'enregistrement dans la table 'favoris'
            $q3 = "DELETE FROM favoris WHERE id_vehicule = :id_vehicule";
            $stmt3 = $conn->prepare($q3);
            $stmt3->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $stmt3->execute();
    
            // Supprimer l'enregistrement dans la table 'notes'
            $q4 = "DELETE FROM notes WHERE id_vehicule = :id_vehicule";
            $stmt4 = $conn->prepare($q4);
            $stmt4->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $stmt4->execute();
    
            // Supprimer le véhicule dans la table 'vehicules'
            $q5 = "DELETE FROM vehicules WHERE id_vehicule = :id_vehicule";
            $stmt5 = $conn->prepare($q5);
            $stmt5->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $stmt5->execute();
    
            $conn->commit();
            $this->disconnect($conn);
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, annuler les modifications
            $conn->rollBack();
            $this->disconnect($conn);
            return false;
        }
    }
    
    function updateMarque($id_marque,$nom_marque,$pays_origine,$siege_social,$annee_creation,$lien_marque,$image_marque){ //modififier une marque
       
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "UPDATE `marques` SET 
        nom_marque = :nom_marque,
        pays_origine = :pays_origine,
        siege_social = :siege_social,
        annee_creation = :annee_creation,
        lien_marque = :lien_marque,
        image_marque = :image_marque
        WHERE id_marque = :id_marque";
        $stmt = $conn->prepare($q);
        // Liaison des paramètres
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
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
    function updateVehicule($id_vehicule,$id_marque, $modele, $version,$annee,$dimensions,$consommation,$moteur,$performances,$couleur,$type_vehicule,$tarif,$image_vehicule,$capacite_moteur,$poids,$capacite_reservoir,$vitesse_max,$style,$type_carburant,$transmission,$nombre_portes,$nombre_places) {
        
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        $q = "UPDATE `vehicules` SET 
            id_marque = :id_marque,
            modele = :modele,
            version = :version,
            annee = :annee,
            dimensions = :dimensions,
            consommation = :consommation,
            moteur = :moteur,
            performances = :performances,
            couleur = :couleur,
            type_vehicule = :type_vehicule,
            tarif = :tarif,
            image_vehicule = :image_vehicule,
            capacite_moteur = :capacite_moteur,
            poids = :poids,
            capacite_reservoir = :capacite_reservoir,
            vitesse_max = :vitesse_max,
            style = :style,
            type_carburant = :type_carburant,
            transmission = :transmission,
            nombre_portes = :nombre_portes,
            nombre_places = :nombre_places
        WHERE id_vehicule = :id_vehicule";
    
        $stmt = $conn->prepare($q);
    
        // Liaison des paramètres
        $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
        $stmt->bindParam(':version', $version, PDO::PARAM_STR);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
        $stmt->bindParam(':consommation', $consommation, PDO::PARAM_STR);
        $stmt->bindParam(':moteur', $moteur, PDO::PARAM_STR);
        $stmt->bindParam(':performances', $performances, PDO::PARAM_STR);
        $stmt->bindParam(':couleur', $couleur, PDO::PARAM_STR);
        $stmt->bindParam(':type_vehicule', $type_vehicule, PDO::PARAM_INT);
        $stmt->bindParam(':tarif', $tarif, PDO::PARAM_STR);
        $stmt->bindParam(':image_vehicule', $image_vehicule, PDO::PARAM_STR);
        $stmt->bindParam(':capacite_moteur', $capacite_moteur, PDO::PARAM_STR);
        $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
        $stmt->bindParam(':capacite_reservoir', $capacite_reservoir, PDO::PARAM_STR);
        $stmt->bindParam(':vitesse_max', $vitesse_max, PDO::PARAM_STR);
        $stmt->bindParam(':style', $style, PDO::PARAM_STR);
        $stmt->bindParam(':type_carburant', $type_carburant, PDO::PARAM_STR);
        $stmt->bindParam(':transmission', $transmission, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_portes', $nombre_portes, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_places', $nombre_places, PDO::PARAM_INT);
    
        $success = $stmt->execute();
        $this->disconnect($conn);
        return $success;
    }
    
    function addVehicule($id_marque, $modele, $version,$annee,$dimensions,$consommation,$moteur,$performances,$couleur,$type_vehicule,$tarif,$image_vehicule,$capacite_moteur,$poids,$capacite_reservoir,$vitesse_max,$style,$type_carburant,$transmission,$nombre_portes,$nombre_places)
    { //fonction pour ajouter un vehicule
      
    $conn = $this->connect("root", "", "TDW", "localhost");
    
    $q = "INSERT INTO `vehicules` (id_marque, modele, version, annee, dimensions, consommation, moteur, performances, couleur, type_vehicule, tarif, image_vehicule, capacite_moteur, poids, capacite_reservoir, vitesse_max, style, type_carburant, transmission, nombre_portes, nombre_places)
    VALUES (:id_marque, :modele, :version, :annee, :dimensions, :consommation, :moteur, :performances, :couleur, :type_vehicule, :tarif, :image_vehicule, :capacite_moteur, :poids, :capacite_reservoir, :vitesse_max, :style, :type_carburant, :transmission, :nombre_portes, :nombre_places)";
    
    $stmt = $conn->prepare($q);
    
    // Liaison des paramètres
    $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
    $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
    $stmt->bindParam(':version', $version, PDO::PARAM_STR);
    $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
    $stmt->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
    $stmt->bindParam(':consommation', $consommation, PDO::PARAM_STR);
    $stmt->bindParam(':moteur', $moteur, PDO::PARAM_STR);
    $stmt->bindParam(':performances', $performances, PDO::PARAM_STR);
    $stmt->bindParam(':couleur', $couleur, PDO::PARAM_STR);
    $stmt->bindParam(':type_vehicule', $type_vehicule, PDO::PARAM_INT);
    $stmt->bindParam(':tarif', $tarif, PDO::PARAM_STR);
    $stmt->bindParam(':image_vehicule', $image_vehicule, PDO::PARAM_STR);
    $stmt->bindParam(':capacite_moteur', $capacite_moteur, PDO::PARAM_STR);
    $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
    $stmt->bindParam(':capacite_reservoir', $capacite_reservoir, PDO::PARAM_STR);
    $stmt->bindParam(':vitesse_max', $vitesse_max, PDO::PARAM_STR);
    $stmt->bindParam(':style', $style, PDO::PARAM_STR);
    $stmt->bindParam(':type_carburant', $type_carburant, PDO::PARAM_STR);
    $stmt->bindParam(':transmission', $transmission, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_portes', $nombre_portes, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_places', $nombre_places, PDO::PARAM_INT);
    
    $success = $stmt->execute();
    $this->disconnect($conn);
    return $success;
    
    }
    

}
?>