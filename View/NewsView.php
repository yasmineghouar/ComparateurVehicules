<?php
require_once ('template.php');

class NewsView extends template{
 

    public function index(){

       $this->main();
       $this->showNews();
       
    }
    
    public function showNews(){
?>
      
      <link rel="stylesheet" type="text/css" href="styles/news.css"></link>
       <script src="js/marques.js"></script>
        <?php
        $cf =  new NewsController();
        $lesNews = $cf->news();//récupèrer les données du controleur
        ?>
         <div class="news-container">
                <?php foreach ($lesNews as $lesNew): ?>
                <div class="news-item">
                <div class="news-item-img">
                    <img src="<?php echo $lesNew['image_url']; ?>" alt="News Image">
                     </div>
                    <div class="news-item-content">
                    <h2><?php echo $lesNew['titre']; ?></h2>
                    <p><?php echo $lesNew['texte']; ?></p>
                    </div>
                    
                    <a href="Controller/TraitementListe.php?id=<?php echo $lesNew['id_news']; ?>" class="read-more">Read More</a>
                    

                </div>
              
                <?php endforeach; ?>
            </div>
         

<?php 
    }

  




    public function showNewsDetails($details){
        ?>
       <!-- les liens des choses ont changé par rapport à la position dufichier qui traite les requetes GET  et affiche les details des articles-->
       <link rel="stylesheet" type="text/css" href="../styles/news.css"></link>
        <?php foreach ($details as $detail): ?>
        
            <div id="news-<?php echo $detail['id_news']; ?>" class="news-details">
 
                <h2><?php echo $detail['titre']; ?></h2>
                <img id="img1" src="../<?php echo $detail['image_url']; ?>" alt="Image 1 news">
                <p><?php echo $detail['paragraphes']; ?></p>
                <div class="image-container">
                
                <img id="img2" src="../<?php echo $detail['image_url_secondaire']; ?>" alt="Image 2 news">
                <img id="img3" src="../<?php echo $detail['image_url_troisieme']; ?>" alt="Image 3 NEWS">
            </div>

   
       
        
    
        </div>

        
        <?php endforeach; ?>
        
        <?php
    }
    


    

}

?>
