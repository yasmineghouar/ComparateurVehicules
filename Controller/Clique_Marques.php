<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marqueId = $_POST['id'];
     // Stocker la valeur de l'ID dans la session, recuperer coté serveur a partir de la requete ajax, apres un clique sur une marque
     $_SESSION['marqueId'] = $marqueId;
     
     // Clear or reset other session data if necessary
     //unset($_SESSION['marqueId']);
     
     echo $marqueId;
    
} else {
    echo 'Erreur: ID de marque et nom de marque non fournis.';
}


?>