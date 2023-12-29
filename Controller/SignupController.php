<?php
require_once('./View/SignupView.php');
require_once('./Model/SignupModel.php');
class SignupController{



    public function index(){
        $v=new SignupView();
        $v->index();
                    
    }

    public function checkUser_byEmail($email){//appel a la fonction model qui verifie l existance de l'@mail

        $signupModel = new SignupModel();
        $r= $signupModel->checkUser_byEmail($email);
        return $r;

    }

    public function insertUser($firstName,$lasName,$email,$sexe,$ddn,$psw){//appel a la fonction model qui insere user dans bdd
        $signupModel = new SignupModel();
        $r=$signupModel->insertUser($firstName,$lasName,$email,$sexe,$ddn,$psw);
        return $r;
    }
     
 
  

}

?>