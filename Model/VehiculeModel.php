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


}
?>
