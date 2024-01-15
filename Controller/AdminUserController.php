<?php

require_once('./View/AdminUserView.php');
require_once('./Model/AdminUserModel.php');

class AdminUserController{



    public function index(){
        $v=new AdminUserView();
        $v->index();

    }
    public function get_all_users(){//fonction qui retourne tout les utilisateurs de la bdd
        $model = new AdminUserModel();
        $resultat = $model->get_all_users();
        return $resultat;
    }
   
}

?>