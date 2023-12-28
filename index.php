<?php
require_once "route.php";
require_once('Controller/GuideAchatController.php');
require_once('Controller/AccueilController.php');
require_once('Controller/ContactController.php');
require_once('Controller/MarquesController.php');
require_once('Controller/VehiculeController.php');
require_once('Controller/NewsController.php');
require_once('Controller/ComparateurController.php');
//require_once('Controller/GuideAchatController.php');
session_start();
$action = $_SERVER['REQUEST_URI'];




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
dispatch($action);
/*$controller = new AccueilController();
$controller->index();*/

?>
