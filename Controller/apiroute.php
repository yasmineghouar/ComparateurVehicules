<?php
include_once("../Model/apirouteModel.php");
include_once("../Model/MarquesModel.php");
include_once("../Model/AdminNewsModel.php");
include_once("../Model/AdminParametreModel.php");
include_once("../Model/AdminUserModel.php");
include_once("../View/UserProfilView.php");
include_once("../Model/UserProfilModel.php");


if (isset($_GET['marqueIdS'])){ //supprimer marque
   $marque_id=$_GET['marqueIdS'];
   unset($_GET['marqueIdS']);
   deleteMarque($marque_id);
    header("location:/Tidjelabine/AdminVehicule");
}

if (isset($_GET['vehiculeIdS'])){ //supprimer vehicule
    $vehicule_id=$_GET['vehiculeIdS'];
    unset($_GET['vehiculeIdS']);
    deleteVehicule($vehicule_id);
     header("location:/Tidjelabine/AdminVehicule");
 }

/*** modification*/

if ( isset($_POST['id_marque_modifier'])){ //moddifier  marque
    $marque_id=$_POST['id_marque_modifier'];
    $marque_nom=$_POST['nom_marque_modifier'];
    $pays_origine=$_POST['pays_origine_modifier'];
    $siege_social=$_POST['siege_social_modifier'];
    $annee_creation=$_POST['annee_creation_modifier'];
    $lien_marque=$_POST['lien_marque_modifier'];
    $image_marque=$_POST['image_marque_modifier'];
    updateMarque($marque_id,$marque_nom,$pays_origine,$siege_social,$annee_creation,$lien_marque,$image_marque);
     header("location:/Tidjelabine/AdminVehicule");
 }
 if ( isset($_POST['id_vehicule_modifier'])){ //moddifier  info vehicules 
    $id_vehicule_modifier=$_POST['id_vehicule_modifier'];
    $nom_marque=$_POST['nom_marque'];
    $modele_modifier=$_POST['modele_modifier'];
    $version_modifier=$_POST['version_modifier'];
    $annee_modifier=$_POST['annee_modifier'];
    $dimensions_modifier=$_POST['dimensions_modifier'];
    $consommation_modifier=$_POST['consommation_modifier'];
    $moteur_modifier=$_POST['moteur_modifier'];
    $performances_modifier=$_POST['performances_modifier'];
    $couleur_modifier=$_POST['couleur_modifier'];
    $type_vehicule_modifier=$_POST['type_vehicule_modifier'];
    $tarif_modifier=$_POST['tarif_modifier'];
    $image_vehicule_modifier=$_POST['image_vehicule_modifier'];
    $capacite_moteur_modifier=$_POST['capacite_moteur_modifier'];
    $poids_modifier=$_POST['poids_modifier'];
    $capacite_reservoir_modifier=$_POST['capacite_reservoir_modifier'];
    $vitesse_max_modifier=$_POST['vitesse_max_modifier'];
    $style_modifier=$_POST['style_modifier'];
    $type_carburant_modifier=$_POST['type_carburant_modifier'];
    $transmission_modifier=$_POST['transmission_modifier'];
    $nombre_portes_modifier=$_POST['nombre_portes_modifier'];
    $nombre_places_modifier=$_POST['nombre_places_modifier'];
     //appelle methode update
    updateVehicule($id_vehicule_modifier,$nom_marque, $modele_modifier, $version_modifier,$annee_modifier,$dimensions_modifier,$consommation_modifier,$moteur_modifier,$performances_modifier,$couleur_modifier,$type_vehicule_modifier,$tarif_modifier,$image_vehicule_modifier,$capacite_moteur_modifier,$poids_modifier,$capacite_reservoir_modifier,$vitesse_max_modifier,$style_modifier,$type_carburant_modifier,$transmission_modifier,$nombre_portes_modifier,$nombre_places_modifier);
    header("location:/Tidjelabine/AdminVehicule");
 }
 
 /** ajout */
 if ( isset($_POST['id_marque_A'])){ //AJOUTER UNE  marque
    $marque_id=$_POST['id_marque_A']; //recuperer les donnée de la nvelle marque à partir des $_post
    $marque_nom=$_POST['nom_marque_A'];
    $pays_origine=$_POST['pays_origine_A'];
    $siege_social=$_POST['siege_social_A'];
    $annee_creation=$_POST['annee_creation_A'];
    $lien_marque=$_POST['lien_marque_A'];
    $image_marque=$_POST['image_marque_A'];
    $marquesModel = new MarquesModel();//appel a la fonction d'ajout dans Marques model
    $marquesModel->addMarque($marque_nom, $pays_origine, $siege_social, $annee_creation, $lien_marque, $image_marque);
     header("location:/Tidjelabine/AdminVehicule");
 }

 if ( isset($_POST['id_vehicule_A'])){ //AJOUTER UN véhicule
    $nom_marque_ajouter=$_POST['nom_marque_ajouter'];
    $modele_A=$_POST['modele_A'];
    $version_A=$_POST['version_A'];
    $annee_A=$_POST['annee_A'];
    $dimensions_A=$_POST['dimensions_A'];
    $consommation_A=$_POST['consommation_A'];
    $moteur_A=$_POST['moteur_A'];
    $performances_A=$_POST['performances_A'];
    $couleur_A=$_POST['couleur_A'];
    $type_vehicule_A=$_POST['type_vehicule_A'];
    $tarif_A=$_POST['tarif_A'];
    $image_vehicule_A=$_POST['image_vehicule_A'];
    $capacite_moteur_A=$_POST['capacite_moteur_A'];
    $poids_A=$_POST['poids_A'];
    $capacite_reservoir_A=$_POST['capacite_reservoir_A'];
    $vitesse_max_A=$_POST['vitesse_max_A'];
    $style_A=$_POST['style_A'];
    $type_carburant_A=$_POST['type_carburant_A'];
    $transmission_A=$_POST['transmission_A'];
    $nombre_portes_A=$_POST['nombre_portes_A'];
    $nombre_places_A=$_POST['nombre_places_A'];
    addVehicule($nom_marque_ajouter, $modele_A, $version_A,$annee_A,$dimensions_A,$consommation_A,$moteur_A,$performances_A,$couleur_A,$type_vehicule_A,$tarif_A,$image_vehicule_A,$capacite_moteur_A,$poids_A,$capacite_reservoir_A,$vitesse_max_A,$style_A,$type_carburant_A,$transmission_A,$nombre_portes_A,$nombre_places_A);
     header("location:/Tidjelabine/AdminVehicule");
 }
/**gestion des avis */
if (isset($_GET['avisS'])){ //supprimer avis
    $avis_id=$_GET['avisS'];
    unset($_GET['avisS']);
    deleteAvis($avis_id);
     header("location:/Tidjelabine/AdminAvis");
 }
 /**valider avis s avis */
if (isset($_GET['avisV'])){ //valider avis
    $avis_id=$_GET['avisV'];
    unset($_GET['avisV']);
    validerAvis($avis_id);
     header("location:/Tidjelabine/AdminAvis");
 }

 /**gestion utilisateurs */
 if (isset($_GET['utilisateurS'])){ //bloquer utilisateur
    $id_utilisateur=$_GET['utilisateurS'];
    unset($_GET['utilisateurS']);
    bloquerUtilisateur($id_utilisateur);
     header("location:/Tidjelabine/AdminAvis");
 }
 /**GESTION ADMIN NEWS : SUPPRESSION ARTICLE */
 if (isset($_GET['newsIdS'])){ //recuperer le get
    $id_news=$_GET['newsIdS'];
    unset($_GET['newsIdS']);
    
    $adminNewsModel = new AdminNewsModel();//instanciation de la classe model
    $adminNewsModel->deleteNews($id_news);//appel a la fonction de suppression du news
  
     header("location:/Tidjelabine/AdminNews");
    
 }
/**modifier un article news */
 if ( isset($_POST['id_news_modifier'])){ //moddifier  mnews
    $id_news_modifier=$_POST['id_news_modifier'];
    $titre_modifier=$_POST['titre_modifier'];
    $texte_modifier=$_POST['texte_modifier'];
    $paragraphes_modifier=$_POST['paragraphes_modifier'];
    $lien_modifier=$_POST['lien_modifier'];
    $image_url_modifier=$_POST['image_url_modifier'];
    $image_url_secondaire_modifier=$_POST['image_url_secondaire_modifier'];
    $image_url_troisieme_modifier=$_POST['image_url_troisieme_modifier'];
    $adminNewsModel = new AdminNewsModel();//instanciation de la classe model
    $adminNewsModel->updateNews($id_news_modifier, $titre_modifier, $image_url_modifier, $texte_modifier, $lien_modifier, $paragraphes_modifier, $image_url_secondaire_modifier, $image_url_troisieme_modifier);//appel a la fonction de modification du news
     header("location:/Tidjelabine/AdminNews");
 }
 /**ajouter un article NEWS */
 if ( isset($_POST['id_news_A'])){ //ajouter news
    $id_news_A=$_POST['id_news_A'];
    $titre_A=$_POST['titre_A'];
    $texte_A=$_POST['texte_A'];
    $paragraphes_A=$_POST['paragraphes_A'];
    $lien_A=$_POST['lien_A'];
    $image_url_A=$_POST['image_url_A'];
    $image_url_secondaire_A=$_POST['image_url_secondaire_A'];
    $image_url_troisieme_A=$_POST['image_url_troisieme_A'];
    $adminNewsModel = new AdminNewsModel();//instanciation de la classe model
    $adminNewsModel->addNews($titre_A, $image_url_A, $texte_A, $lien_A, $paragraphes_A, $image_url_secondaire_A, $image_url_troisieme_A);//appel a la fonction model qui permet d'ajouter dans la bdd le news
     header("location:/Tidjelabine/AdminNews");
 }

 /**modifier contact infos */
 if ( isset($_POST['id_contact'])){ //ajouter news
    $id_contact=$_POST['id_contact'];
    echo $id_contact;
    $adresse=$_POST['adresse'];
    
    $email_contact=$_POST['email_contact'];
    $telephone_contact=$_POST['telephone_contact'];
    $description=$_POST['description'];
    
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->updateContact(1,$adresse, $email_contact ,$telephone_contact, $description);//appel a la fonction model qui permet de modifier dans la bdd le contact info
     header("location:/Tidjelabine/AdminParametres");
 }
 
 /**modifier guide infos */
 if ( isset($_POST['id_guide'])){ //ajouter news
    $id_guide=$_POST['id_guide'];
   
    $guide=$_POST['guide'];
    
    
   
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->updateGuide($id_guide,$guide);//appel a la fonction model qui permet de modifier dans la bdd le guide info
     header("location:/Tidjelabine/AdminParametres");
 }
  /**ajouter dans le guide infos */
  if ( isset($_POST['id_guide_A'])){ //ajouter news
    $id_guide=$_POST['id_guide_A'];
   
    $guide=$_POST['guide_A'];
    
    
   
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel-> add_guide($guide);//appel a la fonction model qui permet d'ajouter' dans la bdd le guide info
     header("location:/Tidjelabine/AdminParametres");
 }

 /**supprimer un conseil du guide d'achat */
 if (isset($_GET['guideIdS'])){ 
    $id_guide=$_GET['guideIdS'];
    unset($_GET['guideIdS']);
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->delete_guide($id_guide) ;//appel a la fonction model qui permet desupprimer un conseil dans la bdd le guide info
     header("location:/Tidjelabine/AdminParametres");
 }
 /**Page ADMIN USERS */
 //supprimer un utilisateur 
 if (isset($_GET['userIdS'])){ //recuperer le get du user à bloquer
    $id_user=$_GET['userIdS'];
    unset($_GET['userIdS']);
    $adminUserModel = new AdminUserModel();//instanciation de la classe model
    $adminUserModel->bloquerUtilisateur($id_user);//appel a la fonction de suppression du user ( bloquage)
     header("location:/Tidjelabine/AdminUser");
 }
  //Valiser inscription d'un utilisateur 
  if (isset($_GET['userIdV'])){ //recuperer le get du user à valider son inscruption
    $id_user=$_GET['userIdV'];
    unset($_GET['userIdV']);
    $adminUserModel = new AdminUserModel();//instanciation de la classe model
    $adminUserModel->validInscrUser($id_user);//appel a la fonction de validation inscription du user 
     header("location:/Tidjelabine/AdminUser");
 }
 
 if (isset($_GET['ProfileUser'])){ //recuperer l'id de l'utilisateur pour afficher sa page profile
    $id_user=$_GET['ProfileUser'];
    unset($_GET['ProfileUser']);
    $usercf = new UserProfilModel();
    $vehiculesFav=$usercf->getFavorisDetails($id_user);//recuperer les vehicules favoris du user
    $resNomPre=$usercf->getUserNomPrenom($id_user);//recuperer son nom et son prenom
    $userProfilView = new UserProfilView();//instanciation de la classe model
    $userProfilView->show_user_details_for_admin($vehiculesFav,$resNomPre);//appel a la fonction de validation inscription du user 
     //header("location:/Tidjelabine/AdminUser");
 }

  /**GESTION ADMIN Parametre DIAPO : SUPPRESSION Artcile News */
  if (isset($_GET['newsIdDiapoS'])){ //recuperer le get
    $id_news=$_GET['newsIdDiapoS'];
    unset($_GET['newsIdDiapoS']);
    
    $adminNewsModel = new AdminNewsModel();//instanciation de la classe model
    $adminNewsModel->deleteNews($id_news);//appel a la fonction de suppression du news
  
     header("location:/Tidjelabine/AdminParametres");
    
 }
 /**GESTION ADMIN Parametre DIAPO ajouter un article NEWS */
 if ( isset($_POST['id_newsDiapo_A'])){ //ajouter news
    $id_news_A=$_POST['id_news_A'];
    $titre_A=$_POST['titre_A'];
    $texte_A=$_POST['texte_A'];
    $paragraphes_A=$_POST['paragraphes_A'];
    $lien_A=$_POST['lien_A'];
    $image_url_A=$_POST['image_url_A'];
    $image_url_secondaire_A=$_POST['image_url_secondaire_A'];
    $image_url_troisieme_A=$_POST['image_url_troisieme_A'];
    $adminNewsModel = new AdminNewsModel();//instanciation de la classe model
    $adminNewsModel->addNews($titre_A, $image_url_A, $texte_A, $lien_A, $paragraphes_A, $image_url_secondaire_A, $image_url_troisieme_A);//appel a la fonction model qui permet d'ajouter dans la bdd le news
     header("location:/Tidjelabine/AdminParametres");
 }
 if ( isset($_POST['id_newsDiapo_modifier'])){ //modification news dans paged diapo
 $id_news_modifier=$_POST['id_newsDiapo_modifier'];
    
    $lien_modifier=$_POST['lien_modifier'];
    $image_url_modifier=$_POST['image_url_modifier'];
    $adminParModel = new AdminParametreModel();//instanciation de la classe model
    $adminParModel->update_news_diapo($id_news_modifier, $lien_modifier, $image_url_modifier);//appel a la fonction de modification du news
     header("location:/Tidjelabine/AdminParametres");
 }
 /**GESTION ADMIN Parametre DIAPO ajouter un article Publicité */
 if ( isset($_POST['id_publicite_A'])){ //ajouter pub
    $id_news_A=$_POST['id_publicite_A'];
   
    $lien_A=$_POST['lien_ajout'];

    $image_url_A=$_POST['image_url_ajout'];
    
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->add_pub($image_url_A, $lien_A);//appel a la fonction model qui permet d'ajouter dans la bdd le pub
     header("location:/Tidjelabine/AdminParametres");
 }
  /**GESTION ADMIN Parametre DIAPO supprmer un article Publicité */
  if ( isset($_GET['pubIdDiapoS'])){ //ajouter pub
    $id_pub=$_GET['pubIdDiapoS'];
    unset($_GET['pubIdDiapoS']);
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->delete_pub($id_pub);//appel a la fonction de suppression du pub
  
     header("location:/Tidjelabine/AdminParametres");
    }
    
   /**GESTION ADMIN Parametre DIAPO supprmer un article Publicité */
   if ( isset($_POST['id_publicite_modifier'])){
   
    $id_pub=$_POST['id_publicite_modifier'];
    echo $id_pub;
    $img_pub=$_POST['image_pub_url_modifier'];
    $lien_pub=$_POST['lien_pub_modifier'];
    $adminParametreModel = new AdminParametreModel();//instanciation de la classe model
    $adminParametreModel->update_pub($id_pub,$img_pub, $lien_pub);//appel a la fonction de modification du pub
    header("location:/Tidjelabine/AdminParametres");
   }

?>