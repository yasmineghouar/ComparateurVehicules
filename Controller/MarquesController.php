<?php
require_once('./Model/MarquesModel.php');
require_once('./View/MarquesView.php');

class MarquesController{



    public function index(){
        $v=new MarquesView();
        $v->index();
                    
    }
     
 
    public function BigZone1()
    {
        $marquesmodel = new MarquesModel();
        $r=$marquesmodel->getBigZone1();
        return $r;//retourne les lmarques
    }
    
    public function pcars_by_marque($marqueId){ //fonction qui recupere les voitures d unemarque donnée
        $marquesmodel = new MarquesModel();
        $pcars = $marquesmodel->get_pcars_by_marque($marqueId);
         return $pcars;
    }


}

?>