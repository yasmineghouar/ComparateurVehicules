<?php

require_once('./View/AdminAccueilView.php');

class AdminAccueilController{



    public function index(){
        $v=new AdminAccueilView();
        $v->index();

    }


}

?>