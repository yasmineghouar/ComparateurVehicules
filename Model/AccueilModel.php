<?php
require_once ('templateModel.php');
class AccueilModel extends templateModel {
   /* private $host = "localhost";
    private $dbname = "TDW";
    private $user = "root";
    private $password = "";

    //private $conn;

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
     private function requete($conn,$r){
        return $conn->query($r);
      }
     
*/
public function getDiaporama(){ //recupere les news et les publicités et leurs liens
    $conn = $this->connect("root", "", "TDW", "localhost");
    
   

    // Sélection des images et liens de la table publicites
    $qPublicites = "SELECT image_url, lien FROM publicites";
    $rPublicites = $this->request($conn, $qPublicites);
     // Sélection des images et liens de la table news
     $qNews = "SELECT image_url, lien FROM news";
     $rNews = $this->request($conn, $qNews);

    // Fusionner les résultats des deux requêtes
    $result = array_merge($rNews, $rPublicites);
    // Désordonner les lignes aléatoirement
     shuffle($result);

    $this->disconnect($conn);

    return $result;
}

    /*public function getDiaporama(){
        $conn=$this->connect("root","","TDW","localhost");
       $q= "SELECT image_url, lien FROM news";
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }*/
    public function getMenu(){//recuperer les elements du menu
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT nom_element, lien_element FROM elementsMenu";
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }
    public function getZone1(){//recuperer les logo des principales marques
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT nom_marque, image_marque ,lien_marque FROM marques WHERE nom_marque IN ('Mercedes-Benz', 'BMW', 'Volkswagen')";//recuperer les principales marques
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }
    
    public function get_marques(){//récupérer les marques existentes
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT id_marque, nom_marque FROM marques";//récuperer les marques depuis la table marques
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;
    }

    public function get_modeles(){//récupérer les marques existentes
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT modele FROM vehicules";//récuperer les marques depuis la table marques
        $r= $this->request($conn,$q);
        return $r;
    }
   public function get_modeles_by_marque($id_marque){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT modele
              FROM vehicules
              WHERE id_marque = :id_marque";

        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect($conn);
        return $result;
    }
    public function get_versions_by_modele($modele){
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT DISTINCT version
              FROM vehicules
              WHERE modele = :modele";
    
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $this->disconnect($conn);
        return $result;
    }
    public function get_annee_by_version($version) {
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT DISTINCT annee
              FROM vehicules
              WHERE version = :version";
    
        $stmt = $conn->prepare($q);
        $stmt->bindParam(':version', $version, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $this->disconnect($conn);
        return $result;
    }

    public function getMostPopularComparison() {
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        // Sélectionner les deux ID des véhicules avec le nombre de clics le plus élevé
        $query = "SELECT id_vehicule_1, id_vehicule_2
                  FROM comparaisons
                  ORDER BY nbr_cliques DESC
                  LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        // Récupérer les résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Fermer la connexion
        $conn = null;
    
        return $result;
    }


    public function getSecondMostPopularComparison() {
        $conn = $this->connect("root", "", "TDW", "localhost");
    
        // Sélectionner les deux ID des véhicules avec le deuxième nombre de clics le plus élevé
        $query = "SELECT id_vehicule_1, id_vehicule_2
                  FROM comparaisons
                  ORDER BY nbr_cliques DESC
                  LIMIT 1 OFFSET 1";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        // Récupérer les résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Fermer la connexion
        $conn = null;
    
        return $result;
    }
    


    
}

?>
