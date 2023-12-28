<?php
require_once('./Model/VehiculeModel.php');
require_once('./View/VehiculeView.php');

class VehiculeController{



    public function index(){
        $v=new VehiculeView();
        $v->index();
                    
    }
     
 
    
    public function cars_details($id_vehicule){ //fonction qui recupere les details d'une voiture à partir de son ID ( en appelant une fct model)
        $vehiculemodel = new VehiculeModel();
        $carsdetails = $vehiculemodel->get_cars_details($id_vehicule);
         return $carsdetails;
    }

    public function traitement_liste(){//fonction qui traite la requete de liste deroulante dans la page Marques; permet d'afficher les details du véhciule selectionné
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehiculeId = $_POST['vehiculeId'];
            $v=new VehiculeView();
            $v->index();
            $v->showVehiculeDetails($vehiculeId);
            
            
            exit;
        }else{
            echo "erreur chargementttttt page Vehicule";
        }




        
    }
    



}

?>