<?php
require_once ('templateModel.php');
class   NewsModel extends templateModel {


    public function getNews(){
        $conn=$this->connect("root","","TDW","localhost");
       $q= "SELECT * FROM news";
        $r= $this->request($conn,$q);
        $this->disconnect($conn);
        return $r;

    }

   
    public function get_news_details($id_news){//recuperer les details de l'article news'
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT *
              FROM news
              WHERE id_news = :id_news";

        $stmt = $conn->prepare($q);
        $stmt->bindParam(':id_news', $id_news, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect($conn);
        return $result;
    }

}
?>
