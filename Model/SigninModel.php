<?php
require_once ('templateModel.php');
class   SigninModel extends templateModel {

    



    public function login($email, $password){//fonction qui verifie l'email et pswwd pour pvoirr s'authentifier
        //$psw c'est un haché du password inséré 
        // Récupérer l'utilisateur avec l'email fourni
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT COUNT(*) AS count FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
        $stmt = $conn->prepare($q);
   

      // Liaison des paramètres avec la requête préparée
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':mot_de_passe', $password);
         
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->disconnect($conn);
            return ($result['count'] > 0); // Retourne true si l'utilisateur existe, sinon false;
    }

/**fct qui verifie si l'utilisateur est bloqué dans la bdd */
public function estUtilisateurBloque($email, $password) {
    $conn = $this->connect("root", "", "TDW", "localhost");
    
    // Sélectionner l'état de blocage de l'utilisateur avec l'email et le mot de passe fournis
    $q = "SELECT est_bloque FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
    $stmt = $conn->prepare($q);
    
    // Liaison des paramètres avec la requête préparée
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $password);
    
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->disconnect($conn);
    
    if ($result !== false) {
        return (bool)$result['est_bloque']; // Retourne true si l'utilisateur est bloqué, sinon false
    } else {
        // Les informations d'identification fournies ne correspondent à aucun utilisateur
        return false;
    }
}

    

    public function getUserIDbyEmail($email){
        
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        
        $q = "SELECT id_utilisateur FROM utilisateurs WHERE email = :email";
        $stmt = $conn->prepare($q);
    
        // Liaison du paramètre avec la requête préparée
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        // Récupération du résultat sous forme d'un seul champ (id_utilisateur) au lieu du tab associatif
        $result = $stmt->fetchColumn();
    
        // Fermeture de la connexion à la base de données
        $this->disconnect($conn);
    
        // Retourne les informations de l'utilisateur ou null si l'utilisateur n'existe pas
        return $result;
    }
    



    }
    



?>
