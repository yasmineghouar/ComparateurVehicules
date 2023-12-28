<?php

require_once('./View/ComparateurView.php');

class ComparateurController{



    public function index(){
        $v=new ComparateurView();
        $v->index();
                    
    }
     
 
   


}

?>