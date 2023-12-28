//fichier de gestion de la base de données
//// Méthodes pour la connexion, l'exécution de requêtes, etc.
<?php

class Database {
    private $host = "localhost";
    private $dbname = "comparateur_vehicules";
    private $user = "root";
    private $password = "";

    private $conn;

    // Méthode pour la connexion à la base de données
    private function connect($user, $password, $dbname, $host){
        $dsn="mysql:dbname=$dbname; host:$host;";
        try{
         $c = new PDO($dsn,$user,$password);
        }
        catch(PDOException $ex){
            printf("erreur cnx a la base de données ",$ex->getMessage());
            exit();
        }
        return $c;
    
    }

// Méthode pour la déconnexion à la base de données
    private function disconnect(&$c){
        $c=null;
    }

    // Méthode pour exécuter une requête
    private function request($c,$r){
        $stmt = $c->prepare($r);
        $stmt ->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     


    
}

?>
