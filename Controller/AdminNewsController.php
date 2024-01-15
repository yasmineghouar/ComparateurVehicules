<?php

require_once('./View/AdminNewsView.php');
require_once('./Model/AdminNewsModel.php');

class AdminNewsController{



    public function index(){
        $v=new AdminNewsView();
        $v->index();

    }
    public function get_all_news(){//fonction qui retourne tous les article des news
        $m= new AdminNewsModel();
        $r = $m->get_all_news(); //appeler la methode du model
        return $r;
      }

}

?>