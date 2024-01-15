<?php
require_once('./Model/UserProfilModel.php');
require_once('./View/UserProfilView.php');

class UserProfilController{



    public function index(){
        $v=new UserProfilView();
        $v->index();

    }

   public function getUserNomPrenom($id_utilisateur){
      $userM = new UserProfilModel();
      $res =  $userM->getUserNomPrenom($id_utilisateur);
      return $res;
   }
    
   public  function getFavorisDetails($id_utilisateur){
    $userM = new UserProfilModel();
    $res =  $userM->getFavorisDetails($id_utilisateur);
    return $res;
   }
   

}

?>