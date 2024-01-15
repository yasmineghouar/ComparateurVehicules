<?php

require_once('./View/AdminVehiculeView.php');

class AdminVehiculeController{



    public function index(){
        $v=new AdminVehiculeView();
        $v->index();

    }
    public function afficherVehiculesMarque(){
        /**cette fonction traite la requete post lors du clique sur le bouton afficher véhicule */
        if (isset($_POST['showVehicMarque'])) {//recuperer l'id de la marque choisie a afficher ses vehicules
            $marqueId = $_POST['showVehicMarque'];
            $v=new AdminVehiculeView();
            $v->main();
            $v->show_vehicules($marqueId); //appeler la methode view qui affiche le tableau des vehicules de la marque
            $v->show_footer();
            //$v->showDonnerNote($vehiculeId);//envoyer le vehicule ID a la fonction showAvis puis dans la fonction utiliser ce vehiculeet appeler la fct qui insert l'avis 
            //$v->showDonner();
            
            exit;
        }else{
            echo "erreur chargementttttt tableau véhicules marque cliqué";
        }
  

    }

  
}

?>