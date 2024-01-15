<?php
require_once "route.php";
require_once('Controller/GuideAchatController.php');
require_once('Controller/AccueilController.php');
require_once('Controller/ContactController.php');
require_once('Controller/MarquesController.php');
require_once('Controller/VehiculeController.php');
require_once('Controller/NewsController.php');
require_once('Controller/ComparateurController.php');
require_once('Controller/SignupController.php');
require_once('Controller/SigninController.php');
require_once('Controller/AdminAccueilController.php');
require_once('Controller/AdminVehiculeController.php');
require_once('Controller/AdminAvisController.php');
require_once('Controller/AdminNewsController.php');
require_once('Controller/UserProfilController.php');
require_once('Controller/AvisController.php');
require_once('Controller/AdminParametreController.php');
require_once('Controller/AdminUserController.php');

//require_once('Controller/GuideAchatController.php');
session_start();
if (isset($_SESSION["role"])){
    $role=$_SESSION["role"];
}else{
    $role='';
}
$action = $_SERVER['REQUEST_URI'];
//on peut pas rentrer aux pages administrateur en tapant leurs url sur le navigateur..
if (($action=='/Tidjelabine/AdminAccueil') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}
if (($action=='/Tidjelabine/AdminVehicule') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}
if (($action=='/Tidjelabine/AdminAvis') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}
if (($action=='/Tidjelabine/AdminNews') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}
if (($action=='/Tidjelabine/Parametres') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}
if (($action=='/Tidjelabine/AdminUser') and($role!="admin")){
    $controller = new SigninController();
    $controller->index();
    exit();
}

route('/Tidjelabine/', function () {
    $controller = new AccueilController();
    $controller->index();
});


route('/Tidjelabine/index.php', function () {
    $controller = new AccueilController();
    $controller->index();
});

/*route('/Tidjelabine/Accueil', function () {
    $controller = new AccueilController();
    $controller->index();
});*/

route('/Tidjelabine/GuideAchat', function () {
    $controller = new GuideAchatController();
    $controller->index();
    /*error_log("Requested URI: $action");
    $controller = new GuideAchatController();
    $controller->index();*/
});

route('/Tidjelabine/Contact', function () {
    $controller = new ContactController();
    $controller->index();
   
});

route('/Tidjelabine/Accueil', function () {
    $controller = new AccueilController();
    $controller->index();
   
});
route('/Tidjelabine/TraitementFormulaire', function () {
    $controller = new AccueilController();
    $controller->traitementFormulaire();
});
route('/Tidjelabine/TraitementListe', function () {
    $controller = new VehiculeController();
    $controller->traitement_liste();
});

route('/Tidjelabine/TraitementListeAvis', function () {
    $controller = new VehiculeController();
    $controller->traitement_liste_avis();
});

route('/Tidjelabine/Marques', function () {
    $controller = new MarquesController();
    $controller->index();
});
route('/Tidjelabine/News', function () {
    $controller = new NewsController();
    $controller->index();
});

route('/Tidjelabine/TraitementNews', function () {
    $controller = new NewsController();
    $controller->index();
});
route('/Tidjelabine/Comparateur', function () {
    $controller = new ComparateurController();
    $controller->index();
});

route('/Tidjelabine/SignUp', function () {
    $controller = new SignupController();
    $controller->index();
});
route('/Tidjelabine/SignIn', function () {
    $controller = new SigninController();
    $controller->index();
});
route('/Tidjelabine/Vehicule', function () {
    $controller = new VehiculeController();
    $controller->index();
});
route('/Tidjelabine/AdminAccueil', function () {
    $controller = new AdminAccueilController();
    $controller->index();
});
route('/Tidjelabine/AdminVehicule', function () {
    $controller = new AdminVehiculeController();
    $controller->index();
});
route('/Tidjelabine/AdminAvis', function () {
    $controller = new AdminAvisController();
    $controller->index();
});
route('/Tidjelabine/AdminNews', function () {
    $controller = new AdminNewsController();
    $controller->index();
});
route('/Tidjelabine/UserProfil', function () {
    
    $controller = new UserProfilController();
    $controller->index();
});
route('/Tidjelabine/Avis', function () {
    $controller = new AvisController();
    $controller->index();
});
route('/Tidjelabine/AdminParametres', function () {
    $controller = new AdminParametreController();
    $controller->index();
});
route('/Tidjelabine/AdminUser', function () {
    $controller = new AdminUserController();
    $controller->index();
});

route('/Tidjelabine/ShowComparaison', function () {
    $controller = new AccueilController();
    $controller->requeteShowMostPopular();
});

route('/Tidjelabine/AdminVehiculesMarques', function () {
    $controller = new AdminVehiculeController();
    $controller->afficherVehiculesMarque();
});
route('/Tidjelabine/ShowDetailsMarque', function () {
    $controller = new MarquesController();
    $controller->showDetailsMarque();
});
route('/Tidjelabine/ShowDetailsMarqueAvis', function () {
    $controller = new AvisController();
    $controller->showDetailsMarqueAvis();
});

    route('/Tidjelabine/LikeAvisVehc', function () {
        $controller = new VehiculeController();
        $controller->traitementLikeAvisVehc();
    });

dispatch($action);
/*$controller = new AccueilController();
$controller->index();*/

?>
