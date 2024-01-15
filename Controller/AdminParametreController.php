<?php

require_once('./View/AdminParametreView.php');
require_once('./Model/AdminParametreModel.php');

class AdminParametreController{



    public function index(){
        $v=new AdminParametreView();
        $v->index();

    }
    public function get_pubs(){ //fct retourne les publicités existantes qui s affiche dans la diapo
        $adminParametreModel = new AdminParametreModel();
        $r=$adminParametreModel->get_pubs();
        return $r;//retourne les details des pubs
    }
}

?>