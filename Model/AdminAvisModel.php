
<?php
require_once ('templateModel.php');
class AdminAvisModel extends templateModel {//recuperer le guide depuis la bdd

/**fonction qui permet de voir tous les avis d'un vehicule donné */
public function get_all_avis() {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "SELECT avis.id_avis,utilisateurs.id_utilisateur,utilisateurs.nom, utilisateurs.prenom, avis.commentaire, avis.id_vehicule,avis.statut,vehicules.id_vehicule,vehicules.id_marque,vehicules.modele,vehicules.version,vehicules.annee
          FROM avis
          INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur 
          INNER JOIN vehicules ON avis.id_vehicule = vehicules.id_vehicule ";
          
          $result = $this->request($conn, $q);

          $this->disconnect($conn);
          return $result;
 
}


}
?>