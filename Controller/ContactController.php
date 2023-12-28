<?php
require_once('./Model/ContactModel.php');
require_once('./View/ContactView.php');

class ContactController{



    public function index(){
        $v=new ContactView();
        $v->index();
                    
    }
     
 
    public function ContactInfos() {
        $contactModel = new ContactModel();
        $r=$contactModel->getContact();
        return $r;//retourne les infos contacte 
    }


}

?>