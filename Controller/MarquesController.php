<?php
require_once('./Model/MarquesModel.php');
require_once('./View/MarquesView.php');

class MarquesController{



    public function index(){
        $v=new MarquesView();
        $v->index();
                    
    }
     
 
    public function BigZone1()
    { //retourne les details des marques qui existe dan sla bdd
        $marquesmodel = new MarquesModel();
        $r=$marquesmodel->getBigZone1();
        return $r;//retourne les lmarques
    }
    
    public function pcars_by_marque($marqueId){ //fonction qui recupere les voitures d unemarque donnée
        $marquesmodel = new MarquesModel();
        $pcars = $marquesmodel->get_pcars_by_marque($marqueId);
         return $pcars;
    }

    /**fonction qui permet d'inserer un avis sur une marque */
    public function insertAvisMarque($id_utilisateur, $id_marque, $commentaire) {
        $marquesemodel = new MarquesModel();
        $marquesemodel->insertAvisMarque($id_utilisateur, $id_marque, $commentaire);

    }
    /**fonction qui permet de voir les avis d'une marque */
    public function voir_tous_avis_marque($id_marque){//fonction qui retourne nom, prenom, commentaire,date, nbr appreciatio  sur le vehicule$id_vehicule
        $marquesemodel = new MarquesModel();
        $commentaires = $marquesemodel->voir_tous_avis_marque($id_marque);
         return $commentaires;
      }
       /*fonction qui appelle celle du model pour inserer une note d'un vehicule attrivué par un user */
    public function insertNoteMarque($id_utilisateur,$id_marque,$note){
        $marquesemodel = new MarquesModel();
        $marquesemodel->insertNoteMarque($id_utilisateur,$id_marque,$note);
    }
/** ftc qui affiche la note moyenne d'un vehicule */
          public function getMoyenneNotesMarque($id_marque){
            $marquesemodel = new MarquesModel();
            $marquNote=$marquesemodel->getMoyenneNotesMarque($id_marque);
            return $marquNote;
          }
   
    /**fct qui traite la requete post lors du clique sur une image lien LOGO MARQUE pour instancier view et appeler methodeView Show_Details_Marque */
    //cette fct traite aussi les post request pr envoyer un avis sur une marque ou une note sur une marque
    public function showDetailsMarque(){
        if (isset($_POST['marqueIdClik'])) {
            
            $marqueIdClik = $_POST['marqueIdClik'];//recuperer id marque cliquee par variable post
            
            $v=new MarquesView();
            $v->main();
            $v->showBigZone2($marqueIdClik); //j appelle lamethode view aevc comme parametre l id recuperé
            $v->show_footer();
            
            exit;
        }
        if (isset($_POST['avisMarque'])){ //taritement POSTREQUEST lors de l'envoit d'un avis sur une marque
            
           
            $marque_id_post = $_POST['marqueId'];
            $commentaire=$_POST['avisMarque'];
            $id_utilisateur=$_SESSION["user"];//recuperer l'id du user qui a commenté
            
            $this->insertAvisMarque($id_utilisateur, $marque_id_post, $commentaire);//appeler la fct du controlleur qui insert l'avis ajouté qui appelle a son tour la dct model qui insert dans la bdd
            $v=new MarquesView();
            $v->main();
            $v->showBigZone2($marque_id_post);
            $v->show_footer();
            exit;
            }
                    /**traitement formulaire note */
        if (isset($_POST['noteMarque'])){
           
        
        // Récupérer la valeur de marqueId à partir du champ caché
        $marque_id_post = $_POST['marqueIdNote'];
        $note=$_POST['noteMarque'];
        $id_utilisateur=$_SESSION["user"];
        
        $this->insertNoteMarque($id_utilisateur,$marque_id_post,$note);//appel dct qui insert la note qui appelle a son tour celle du model qui insert dans la bdd
        $v=new MarquesView();//appeler le view 
        $v->main();
        $v->showBigZone2($marque_id_post);
        $v->show_footer();
        exit;
        }
        if (isset($_POST['avisFavMrk']) && isset($_POST['idUserClk'])) { //traitement requete ajax post pour liker un commentaire de marque
            
            $avisFavMrk=$_POST['avisFavMrk'];//recupérer le commentaire liké

            $idUserClk=$_POST['idUserClk'];//recuperer le user qui a liké
            $avisModel = new AvisModel();

            //verifier que le user  n'a pas déja liker le meme avis auparavant avant d'eectuer APPRECIER AVIS
            if(!$avisModel->utilisateurAvisMarqueExists($idUserClk,$avisFavMrk)){//incrementer nombre de like de l'avis courant que si ce user ne l'a pas déja fait
                $avisModel->enregistrerLikeMarque($idUserClk,$avisFavMrk);
                $avisModel->apprecierAvisMarque($avisFavMrk);//incrementer nbre appreciation du commentaire marque

            }
            
            $nbre_appreciation =  $avisModel->getNombreAppreciationsAvisMrk($avisFavMrk);//afficher le nouveau nombre d'appreciation 
           echo $nbre_appreciation;
            
           /*$v=new MarquesView();//appeler le view 
           $v->main();
           $v->showBigZone2($marque_id_post);
           $v->show_footer();*/
       
        
        }
    }

}

?>