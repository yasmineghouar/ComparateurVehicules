<?php
//Le controleur invoque les modèles et les vues afin de 
//récupérer des données qu’ils vont etre traiter et gérer
//le contrôleur récupère les informations des news à partir du modèle
require_once('./Model/NewsModel.php');
require_once('./View/NewsView.php');

class NewsController{



    public function index(){
       
        $v=new NewsView();
      
        $v->index();
    }


    public function news()
    {
        $newsmodel = new NewsModel();
        $r=$newsmodel->getNews();
        return $r;//retourne les details des news
    }
     
    public function news_details($id_news){ //fonction qui recupere les details d'un article news( en appelant une fct model)
        $newsmodel = new NewsModel();
        $newsdetails = $newsmodel->get_news_details($id_news);
         return $newsdetails;
    }


    public function traitement_news(){//fonction qui traite la requete get du news que je veux detailler
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $vehiculeId = $_GET['vehiculeId'];
            $v=new VehiculeView();
            $v->index();
            $v->showVehiculeDetails($vehiculeId);
            
            
            exit;
        }else{
            echo "erreur chargement page Vehicule";
        }
    }




}
?>