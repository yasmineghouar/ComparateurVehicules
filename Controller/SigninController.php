<?php
require_once('./View/SigninView.php');
require_once('./Model/SigninModel.php');
class SigninController{



    public function index(){
        $v=new SigninView();
        $v->index();
                    
    }

    
    public function Login($email,$pwd){ //connexion de l''utilisateur
    $signinModel = new SigninModel();
    $r=$signinModel->login($email,$pwd);
    return $r;
    } 

    public function getUserIDbyEmail($email){//recuper id de user d'apres son email
        $signinModel = new SigninModel();
        $r= $signinModel->getUserIDbyEmail($email);
        return $r;
    }
    

    public function Logout(){ //deconnexion de l''utilisateur
    session_destroy();
    echo "<script type='text/javascript'>location.href = '/Tidjelabine/';</script>";
    } 
 
  

}

?>