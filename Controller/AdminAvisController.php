<?php

require_once('./View/AdminAvisView.php');
require_once('./Model/AdminAvisModel.php');
class AdminAvisController{



    public function index(){
        $v=new AdminAvisView();
        $v->index();

    }
    public function get_all_avis(){
        $m= new AdminAvisModel();
        $r = $m->get_all_avis();
        return $r;
      }

}

?>