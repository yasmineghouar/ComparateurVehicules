<?php
session_start();
require_once ('templateModel.php');


function deleteMarque($id_marque){ //supprimer une marque à partir de son id
    $model=new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
    $q = "DELETE FROM `marques` WHERE id_marque = :id_marque";
    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
    $success = $stmt->execute();
    $model->disconnect($conn);
    return $success;
 
}

function updateMarque($id_marque,$nom_marque,$pays_origine,$siege_social,$annee_creation,$lien_marque,$image_marque){ //modififier une marque
    $model=new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
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
    $model->disconnect($conn);
    return $success;
 
}

function addMarque($nom_marque, $pays_origine, $siege_social, $annee_creation, $lien_marque, $image_marque) {//ajouter une marque a la table des marques
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
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
    $model->disconnect($conn);
    return $success;
}

function deleteVehicule($id_vehicule){ //supprimer un véhicule à partir de son id
    $model=new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
    $q = "DELETE FROM `vehicules` WHERE id_vehicule = :id_vehicule";
    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $success = $stmt->execute();
    $model->disconnect($conn);
    return $success;
 
}

function updateVehicule($id_vehicule,$id_marque, $modele, $version,$annee,$dimensions,$consommation,$moteur,$performances,$couleur,$type_vehicule,$tarif,$image_vehicule,$capacite_moteur,$poids,$capacite_reservoir,$vitesse_max,$style,$type_carburant,$transmission,$nombre_portes,$nombre_places) {
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");

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
    $model->disconnect($conn);
    return $success;
}

function addVehicule($id_marque, $modele, $version,$annee,$dimensions,$consommation,$moteur,$performances,$couleur,$type_vehicule,$tarif,$image_vehicule,$capacite_moteur,$poids,$capacite_reservoir,$vitesse_max,$style,$type_carburant,$transmission,$nombre_portes,$nombre_places)
{ //fonction pour ajouter un vehicule
    $model = new templateModel();
$conn = $model->connect("root", "", "TDW", "localhost");

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
$model->disconnect($conn);
return $success;

}


/**gestion avis */
function deleteAvis($id_avis) {
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");
    
    $q = "DELETE FROM `avis` WHERE id_avis = :id_avis";
    
    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);
    
    $success = $stmt->execute();
    
    $model->disconnect($conn);
    return $success;
}
function validerAvis($id_avis) {
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `avis` SET statut = 'Valide' WHERE id_avis = :id_avis";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_avis', $id_avis, PDO::PARAM_INT);

    $success = $stmt->execute();

    $model->disconnect($conn);
    return $success;
}
/**gestion utilisateurs */
function bloquerUtilisateur($id_utilisateur) {
    $model = new templateModel();
    $conn = $model->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `utilisateurs` SET est_bloque = true WHERE id_utilisateur = :id_utilisateur";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    $success = $stmt->execute();

    $model->disconnect($conn);
    return $success;
}
?>