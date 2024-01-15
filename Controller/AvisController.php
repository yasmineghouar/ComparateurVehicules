<?php
require_once('./Model/AvisModel.php');
require_once('./View/AvisView.php');

class AvisController{



    public function index(){
        $v=new AvisView();
        $v->index();

    }

    public function apprecierAvis($id_avis){
        $avisModel = new AvisModel();//fct qui permet d'apprecier un avis sur un vehicule
        $r=$avisModel->apprecierAvis($id_avis);
        return $r;
    }

    public function apprecierAvisMarque($id_avis){//fct qui permet d'apprecier un avis sur une marque
        $avisModel = new AvisModel();
        $r=$avisModel->apprecierAvisMarque($id_avis);
        return $r;
    }
  
     public function utilisateurAvisExists($id_utilisateur, $id_avis){//fct qui permet  de verifier si user a liké ce comm ou pas
        $avisModel = new AvisModel();
        $r=$avisModel->utilisateurAvisExists($id_utilisateur, $id_avis);
        return $r;
     }
     public function utilisateurAvisMarqueExists($id_utilisateur, $id_avis){//fct qui permet  de verifier si user a liké ce comm Marque ou pas
        $avisModel = new AvisModel();
        $r=$avisModel->utilisateurAvisMarqueExists($id_utilisateur, $id_avis);
        return $r;
     }

    public function showDetailsMarqueAvis(){//cette fct recuperer les POST pour afficher la page details marque AVIS
        if (isset($_POST['marqueIdClik'])) {
            
            $marqueIdClik = $_POST['marqueIdClik'];
            
            $v=new AvisView(); //appeler le view pr afficher la page details marque dependant du id récupéré par post en haut
            $v->main();
            $v->show_marques_details($marqueIdClik);
            $v->show_footer();
            
            exit;
        }
    }

}

?>