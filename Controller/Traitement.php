<?php
include '../View/ComparateurView.php';
include '../Model/ComparateurModel.php';
// Vérifiez si la requête est une requête AJAX

  if (isset($_POST['marque1'])) {
    $vehiculeId = $_POST['marque1'];
    echo $vehiculeId;
    $comparateurView =new ComparateurModel();
    $comparateurView = new ComparateurView;
    $comparateurView->show_form($vehiculeId);
    }else{
        echo 'rien';
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
 

?>