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

}
?>