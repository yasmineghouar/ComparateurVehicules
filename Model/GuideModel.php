<?php
require_once ('templateModel.php');
class GuideModel extends templateModel {//recuperer le guide depuis la bdd

    public function getGuide(){
       
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT guide FROM guide_infos WHERE id_guide = 1";

        $result = $this->request($conn, $q);

        $this->disconnect($conn);
        return $result;
       
        }
    

        
}
?>