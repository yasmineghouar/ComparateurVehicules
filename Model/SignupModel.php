<?php
require_once ('templateModel.php');
class   SignupModel extends templateModel {

     public function checkUser_byEmail($email){//verifier si ya un utilisateur inscris qui porte cette adresse email
      
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT COUNT(*) AS count FROM utilisateurs WHERE email = :email";
       //Compte le nombre total d'enregistrements dans la table
         $stmt = $conn->prepare($q);
          // Liaison de la valeur avec les paramètres de la requête préparée
         $stmt->bindParam(':email', $email);
         $stmt->execute();
         // Récupération du résultat sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->disconnect($conn);
        return ($result['count'] > 0); // Retourne true si l'utilisateur existe, sinon false

    }



    public function insertUser($firstName,$lasName,$email,$sexe,$ddn,$psw){//inserer l'utilisateur inscris dans la bdd
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "INSERT INTO utilisateurs (nom, prenom, sexe, date_naissance, email, mot_de_passe)
        VALUES (:nom, :prenom, :sexe, :date_naissance, :email, :mot_de_passe)";
  
        //Suppression de la ligne $r->fetchColumn() car une requête d'insertion ne retourne pas de colonne spécifique.
        //uutilisation de requete préparée avec des paramètres liés (bindParam) pour éviter l'injection SQL et améliorer la sécurité.
        $stmt = $conn->prepare($q);


        // Liaison des valeurs avec les paramètres de la requête préparée
         $stmt->bindParam(':nom', $firstName);
         $stmt->bindParam(':prenom', $lasName);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':sexe', $sexe);
         $stmt->bindParam(':date_naissance', $ddn);     
         $stmt->bindParam(':mot_de_passe', $psw);
          // Exécution de la requête préparée
         $r = $stmt->execute();

         $this->disconnect($conn);
         return $r; 
    }


}
?>
