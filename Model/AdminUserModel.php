<?php
require_once ('templateModel.php');
class   AdminUserModel extends templateModel {


/** Fonction qui valide l'inscription d'un utilisateur */
function validate_insc($id_utilisateur) {
    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE utilisateurs SET est_inscrit = true WHERE id_utilisateur = :id_utilisateur";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
   /**fonction qui permet de bloquer un utilisateur qui ne respecte pasla charte d'utilisation */
   function bloquerUtilisateur($id_utilisateur) {

    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `utilisateurs` SET est_bloque = true WHERE id_utilisateur = :id_utilisateur";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
   /**fonction qui permet de valiser l'inscription d'un utilisateur */
   function validInscrUser($id_utilisateur) {

    $conn = $this->connect("root", "", "TDW", "localhost");

    $q = "UPDATE `utilisateurs` SET est_inscrit = true WHERE id_utilisateur = :id_utilisateur";

    $stmt = $conn->prepare($q);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    $success = $stmt->execute();

    $this->disconnect($conn);
    return $success;
}
/**fonction qui permet d'extraire tous les utilsateurs from la bdd */
  function get_all_users(){
    $conn = $this->connect("root", "", "TDW", "localhost");
    $q = "SELECT * FROM  utilisateurs";
    $result = $this->request($conn, $q);

    $this->disconnect($conn);
    return $result;

  }
}
?>
