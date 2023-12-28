<?php

class templateModel {
    protected $host = "localhost";
    protected $dbname = "TDW";
    protected $user = "root";
    protected $password = "";

    private $conn;

    // Méthode pour la connexion à la base de données
    public function connect($user, $password, $dbname, $host){
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
    public function disconnect(&$c){
        $c=null;
    }

    // Méthode pour exécuter une requête
     public function request($c,$r){
        $stmt = $c->prepare($r);
        $stmt ->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }


     public function requete($conn,$r){
        return $conn->query($r);
      }
     





    }
    
    
    
?>