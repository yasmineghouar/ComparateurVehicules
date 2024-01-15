<?php
//Le controleur invoque les modèles et les vues afin de 
//récupérer des données qu’ils vont etre traiter et gérer
//le contrôleur récupère les informations des smartphones à partir du modèle
require_once('./Model/AccueilModel.php');
require_once('./Model/VehiculeModel.php');
require_once('./View/AccueilView.php');
require_once('./View/ComparateurView.php');
class AccueilController{



    public function index(){
        //data collection and security cheking
        $v=new AccueilView();
      /*  $diaporamaImages = $this->diaporama();*/
        $v->index();
    }


    public function diaporama()
    {
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->getDiaporama();
        return $r;//retourne les images et leurs liens
    }

    public function menu()
    {
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->getMenu();
        return $r;//retourne les elemnts du menu
    }

    public function zone1()
    {
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->getZone1();
        return $r;//retourne les logo des marques principales et les liens
    }
    public function marques(){
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->get_marques();
        return $r;//retourne les marques des véhicules
    }

    public function traitementFormulaire(){ //fct qui traite le formulaire de comparaison
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
           
            // Récupérer les données du formulaire
            $marque1 = $_POST['marque1'];
            $modele1 = $_POST['modele1'];
            $version1 = $_POST['version1'];
            $annee1 = $_POST['annee1'];

            $marque2 = $_POST['marque2'];
            $modele2 = $_POST['modele2'];
            $version2 = $_POST['version2'];
            $annee2 = $_POST['annee2'];
            
            $marque3 = $_POST['marque3'];
            $modele3 = $_POST['modele3'];
            $version3 = $_POST['version3'];
            $annee3 = $_POST['annee3'];
            
            $marque4 = $_POST['marque4'];
            $modele4 = $_POST['modele4'];
            $version4 = $_POST['version4'];
            $annee4 = $_POST['annee4'];
             // Construire l'URL de redirection avec les paramètres GET
    
            
            
            // Faites de même pour les autres véhicules (marque2, modele2, ...)
          // Afficher les données sur la page
          echo "Marque1: $marque1, Modèle1: $modele1, Version1: $version1, Année1: $annee1,Marque2: $marque2, Modèle2: $modele2, Version2: $version2, Année2: $annee2,Marque3: $marque3, Modèle3: $modele3, Version3: $version3, Année3: $annee3,Marque4: $marque4, Modèle4: $modele4, Version4: $version4, Année4: $annee4";
           
         
          exit;
        }else{
            echo "..";
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Récupérez les données de l'URL
            $allFormData = $_SERVER['QUERY_STRING'];
            
            // Traitez les données comme nécessaire
            // ...
        
            // Affichez les résultats
            echo "Résultats : " . $allFormData;
        } else {
            // Affichez un message d'erreur ou redirigez l'utilisateur
            echo "rieeeeeeeeeen";
            exit();
        }


    }

    public function cars_details($id_vehicule){ //fonction qui recupere les details d'une voiture à partir de son ID ( en appelant une fct model)
        $vehiculemodel = new VehiculeModel();
        $carsdetails = $vehiculemodel->get_cars_details($id_vehicule);
         return $carsdetails;
    }

    public function getMostPopularComparison(){
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->getMostPopularComparison();
        
        return $r;
    }

    public function getSecondMostPopularComparison(){
        $accueilmodel = new AccueilModel();
        $r=$accueilmodel->getSecondMostPopularComparison();
        return $r;
    }

    public function requeteShowMostPopular(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $idVehicule1 = $_POST['id_vehicule_1'];
           
            $idVehicule2 = $_POST['id_vehicule_2'];
     
            $vehiculeModel = new VehiculeModel();//appeler les methode de vehicule Model
           $detailVehicule1=$vehiculeModel->get_cars_details($idVehicule1);
           $detailVehicule2=$vehiculeModel->get_cars_details($idVehicule2);
        $comparateurview = new ComparateurView();
        $comparateurview->show_header_comparaison();
        $comparateurview->show_menu_comparaison($menuItms);
        $comparateurview->showVehiculeDetailsMultiple2($detailVehicule1,$detailVehicule2);

    }
    }
   /* public function modeles(){
        $accueilmodel = new AccueilModel();
        //$marqueId = $_GET['marqueId'];
        $marqueId = isset($_GET['marqueId']) ? $_GET['marqueId'] : NULL;
        
        $r=$accueilmodel->get_modeles_by_marque($marqueId);
        return $r;//retourne les modeles des véhicules de la marques marqueId
       // Convertit les résultats en JSON et renvoie la réponse
        //header('Content-Type: application/json');
        //echo json_encode($r);
    }*/
    /*public function modeles() {
        $accueilmodel = new AccueilModel();
        $marqueId = isset($_GET['marqueId']) ? $_GET['marqueId'] : NULL;
        
        try {
            $r = $accueilmodel->get_modeles_by_marque($marqueId);
    
            // Vérifier si $r est un tableau avant de l'encoder en JSON
            if (is_array($r)) {
                // Convertit les résultats en JSON et renvoie la réponse
                header('Content-Type: application/json');
                echo json_encode($r);
            } else {
                throw new Exception('Erreur lors de la récupération des modèles.');
            }
        } catch (Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec le message d'erreur
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }*/
   /* public function modeles() {

        $accueilModel = new AccueilModel();
        
        $marqueId = $_GET['marqueId'] ?? null;
        var_dump($marqueId);
       // $marqueId = htmlentities($_GET['marqueId']);
        try {
            $modeles = $accueilModel->get_modeles_by_marque($marqueId);
            
            // Vérifier que $modeles est un tableau
            if(!is_array($modeles)) {
                throw new Exception('Aucun modèle trouvé'); 
            }
            // Transformer le résultat en JSON
            $response = json_encode($modeles);  
            // Définir les entêtes HTTP adéquats
            //header('Content-Type: application/json');
    
            // Afficher la réponse JSON
            echo $response;
         // return $modeles;
        } catch (Exception $e) {
    
            // En cas d'erreur, renvoyer une réponse JSON d'erreur
            $error = ['error' => $e->getMessage()];
            $response = json_encode($error);
            
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            
            echo $response;
        }

} 



public function modeles() {

    $accueilModel = new AccueilModel();
    
    $marqueId = $_GET['marqueId'] ?? null;
    var_dump($marqueId);
   // $marqueId = htmlentities($_GET['marqueId']);
    try {
        $modeles = $accueilModel->get_modeles_by_marque($marqueId);
        
        // Vérifier que $modeles est un tableau
        if(!is_array($modeles)) {
            throw new Exception('Aucun modèle trouvé'); 
        }
        // Transformer le résultat en JSON
        $response = json_encode($modeles);  
        // Définir les entêtes HTTP adéquats
        //header('Content-Type: application/json');

        // Afficher la réponse JSON
        echo $response;
     // return $modeles;
    } catch (Exception $e) {

        // En cas d'erreur, renvoyer une réponse JSON d'erreur
        $error = ['error' => $e->getMessage()];
        $response = json_encode($error);
        
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json');
        
        echo $response;
    }

} */
}
?>