<?php
require_once('./Model/VehiculeModel.php');
require_once('./View/VehiculeView.php');
require_once('./View/AvisView.php');
class VehiculeController{



    public function index(){
        $v=new VehiculeView();
        $v->index();
                    
    }
     
 
    
    public function cars_details($id_vehicule){ //fonction qui recupere les details d'une voiture à partir de son ID ( en appelant une fct model)
        $vehiculemodel = new VehiculeModel();
        $carsdetails = $vehiculemodel->get_cars_details($id_vehicule);
         return $carsdetails;
    }
    public function get_all_cars(){ //fonction qui recupere les details des vehicules
        $vehiculemodel = new VehiculeModel();
        $carsdetails = $vehiculemodel->get_all_cars();
         return $carsdetails;
    }

    public function get_marque_vehicule($id_vehicule){ //fonction qui recupere la marque du vehicule
        $vehiculemodel = new VehiculeModel();
        $marque = $vehiculemodel->get_marque_vehicule($id_vehicule);
         return $marque;
    }

      public function voir_tous_avis($id_vehicule){//fonction qui retourne nom, prenom, commentaire,date, nbr appreciatio  sur le vehicule$id_vehicule
        $vehiculemodel = new VehiculeModel();
        $commentaires = $vehiculemodel-> voir_tous_avis($id_vehicule);
         return $commentaires;
      }
      /**retourne les 3 meilleurs avis */
      public function troisMeilleursAvis($id_vehicule){//fonction qui retourne nom, prenom, commentaire,date, nbr appreciatio
        $vehiculemodel = new VehiculeModel();
        $commentaires = $vehiculemodel->troisMeilleursAvis($id_vehicule);
         return $commentaires;
      }
      
      /**retourn les avis paginés à 5 */
      public function  getAdditionalReviews($id_vehicule, $offset, $limit){ //afficherles avis paginés
        $vehiculemodel = new VehiculeModel();
        $commentaires = $vehiculemodel->getAdditionalReviews($id_vehicule, $offset, $limit);
         return $commentaires;
      }

      public function getSecondPopularComparisonForVehicle($id_vehicule){//retourne la la 2e la comparaison plus populaire d'un vehicule donnée
        $vehiculemodel = new VehiculeModel();
        $r=$vehiculemodel->getSecondPopularComparisonForVehicle($id_vehicule);
        
        return $r;
      }
      public function getMostPopularComparisonForVehicle($id_vehicule){//retourne la comparaisonla plus populaire d'un vehicule donnée
        $vehiculemodel = new VehiculeModel();
        $r=$vehiculemodel->getMostPopularComparisonForVehicle($id_vehicule);
        
        return $r;
      }

    public function traiementNotesAvis($vehiculeId,$avis,$user){//appeler model qui insert l'avis dans la bdd
        
    }
    /*fonction qui appelle celle du model pour inserer une note d'un vehicule attrivué par un user */
    public function insertNote($id_utilisateur,$id_vehicule,$note){
        $vehiculemodel = new VehiculeModel();
        $vehiculemodel->insertNote($id_utilisateur,$id_vehicule,$note);
    }
    public function getMoyenneNotesVehicule($id_vehicule){// fct qui pemrmet d'afficher la moyenne de note attriubué a un vehicule donnée
    $vehiculemodel = new VehiculeModel();
    $noteAvr= $vehiculemodel->getMoyenneNotesVehicule($id_vehicule);//get la moyenne de la note a partir fct model
    return $noteAvr;
    }
     /**fonction qui appelle celle de model pour inserer un avis */
     public function  insertAvis($id_utilisateur, $id_vehicule, $commentaire){

        $vehiculemodel = new VehiculeModel();
        $vehiculemodel->insertAvis($id_utilisateur, $id_vehicule, $commentaire);

     }

    public function traitement_liste(){//fonction qui ; permet d'afficher les details du véhciule selectionné
       //cette fonction qui affiche la page VEHICULE
       //je peux  y acceder par /Tidjelabine/TraitementListe
        if (isset($_POST['vehiculeId'])) {
            
            $vehiculeId = $_POST['vehiculeId'];
            
            $v=new VehiculeView();
            $v->index();
            $v->showVehiculeDetails($vehiculeId);
            $v->show_footer();
            //$v->showDonnerNote($vehiculeId);//envoyer le vehicule ID a la fonction showAvis puis dans la fonction utiliser ce vehiculeet appeler la fct qui insert l'avis 
            //$v->showDonner();
            
            exit;
        }else{
            echo "erreur chargementttttt page Vehicule";
        }
  
    }
    public function traitement_liste_avis(){//fonction qui traite la requete de liste deroulante dans la page AVIS; permet d'afficher les details du véhciule selectionné
        //cette fonction qui affiche la page VEHICULE
         if (isset($_POST['vehiculeId'])) {
             $vehiculeId = $_POST['vehiculeId'];
             $v=new AvisView();
             $v->main();
             $v->show_vehic_details($vehiculeId);
             
             //$v->showDonnerNote($vehiculeId);//envoyer le vehicule ID a la fonction showAvis puis dans la fonction utiliser ce vehiculeet appeler la fct qui insert l'avis 
             //$v->showDonner();
             
             exit;
         }else{
             echo "erreur chargementttttt page Vehicule";
         }
   
     }


    public function traitement_favoris(){ //traitement requete du vehicule 
        if (isset($_GET['vehicFav'])){ //FAVORISSSSSSS
            $vehicFav=$_GET['vehicFav'];
            $userFav=$_GET['userFav'];
            unset($_GET['vehicFav']);
             header("location:/Tidjelabine/");
          }
          
    }
        
    public function traitementLikeAvisVehc(){//traiement requees like commentaire vehicule
    
            
            if (isset($_POST['avisFav'])) {//recuper l'id de l'avis VEHIC liké a partir de la page vehicule
                
                $avisIdClik = $_POST['avisFav'];//recuperer id marque cliquee par variable post
                $id_userLike= $_POST['userLike'];//recuperer le user cliqué
                $avisModel = new AvisModel();
                
                if(!$avisModel->utilisateurAvisExists($id_userLike,$avisIdClik)){//incrementer nombre de like de l'avis courant que si ce user ne l'a pas déja fait
                    $avisModel->enregistrerLike($id_userLike,$avisIdClik);//stocker dans la bdd le like avec celui qui a liké ( user peut pas liker2fois)
                    $avisModel->apprecierAvis($avisIdClik);//appeler la methode qui incremente nbr_appreciartion du commentaire
                 
                }
            $nbre_appreciation =  $avisModel->getNbrLikeAvis($avisIdClik);//afficher le nouveau nombre d'appreciation 
            echo $nbre_appreciation;
                
                exit;
            }
    }



}

?>