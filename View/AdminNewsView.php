<?php
require_once ('template.php');

class AdminNewsView extends template{


    public function index(){

        $this->main();
        $this->show_news();
        $this->show_footer();
        

     }


     public function show_news(){
        ?>
        <link rel="stylesheet" type="text/css" href="styles/admin.css">
      
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!--  cette balise "link" après celle de Bootstrap -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<!-- cette balise "script" après celle de Bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="js/admin.js"></script>

         <?php
        //appeler la methode du controller qui retourne tous les articles des news
        $cf =  new AdminNewsController();
        $articles = $cf->get_all_news();//récupèrer les données du controleur(les articles)
       
        ?>
        <div style="height: 20px;"></div>
          <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les News</h1>
          <!--lien pour ajouter des news-->
          <section class="container">
        <div class="row">
            <div class="col-12">
          <a style="cursor: pointer;" onclick="afficherAjoutNews()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
          <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

          <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID News</th><th data-sortable="true" data-field="titre" data-searchable="true">Titre</th><th>texte</th><th>Lien Web Source</th><th>Page de l'article</th><th>Gestion</th></tr></thead>
          <tbody>
          <?php foreach($articles as $article):?>
            <?php
           
        ?>
          <tr>
          
            <td> <?php echo $article['id_news']; ?></td>
            <td> <?php echo $article['titre']; ?></td>
            <td> <?php echo $article['texte']; ?></td>
            
            <td> <a href="<?php echo $article['lien']; ?>"><?php echo $article['lien']; ?></a></td>
          
           <td> <a href="Controller/TraitementListe.php?id=<?php echo $article['id_news']; ?>" class="read-more" style="display: inline-block; padding: 10px 15px;background-color: #c5a173;color: #ffffff; text-decoration: none; border-radius: 5px;transition: background-color 0.3s ease;">Accéder à l'Article</a></td>
           <!--modifier l'article ou le supprimer--->
            <td>
                <!--lien de suppression news-->
            <a href="/Tidjelabine/Controller/apiroute.php?newsIdS=<?php echo $article['id_news']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
           
            <a style="cursor: pointer;" onclick="afficherModificationNews(<?php echo $article['id_news']; ?>, '<?php echo $article['titre']; ?>', '<?php echo $article['texte']; ?>', '<?php echo $article['paragraphes']; ?>', '<?php echo $article['lien']; ?>', '<?php echo $article['image_url']; ?>', '<?php echo $article['image_url_secondaire']; ?>', '<?php echo $article['image_url_troisieme']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
    
           </tr>
           
          <?php endforeach;?>
          </table>
          
          </div>
          </div>
          </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

          <!-- formulaire de modification News-->
        <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="upFrmNews" style="display: none;">
        <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification News</span> 
             <label for="id_news" hidden></label>
            <input type="number" id="id_news" name="id_news_modifier" hidden>
            <label for="titre">Titre de l'article:</label>
            <input type="text" id="titre" name="titre_modifier">
            <label for="texte">texte de l'article:</label>
            <input type="text" id="texte" name="texte_modifier">
            <label for="paragraphes">Contenu de l'article:</label>
            <input type="text" id="paragraphes" name="paragraphes_modifier">
            <label for="lien">Lien WEB source:</label>
            <input type="text" id="lien" name="lien_modifier">
            <label for="image_url">Image1 de l'article:</label>
            <input type="text" id="image_url" name="image_url_modifier">
            <label for="image_url_secondaire">Image2 article:</label>
            <input type="text" id="image_url_secondaire" name="image_url_secondaire_modifier">
            <label for="image_url_troisieme">image3 article:</label>
            <input type="text" id="image_url_troisieme" name="image_url_troisieme_modifier">
           <button id="btnModifier" onclick="this.form.submit()" name="modifierMarque">Modifier Article</button>
            
        </form>
         <!-- formulaire d'ajouter un article news-->
         <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="FormAjNews" style="display: none;">
         <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout News</span> 
         <label for="id_news" hidden> </label>
            <input type="number" id="id_news" name="id_news_A" hidden>
            <label for="titre">Titre de l'article:</label>
            <input type="text" id="titre" name="titre_A" required>
            <label for="texte">texte de l'article:</label>
            <input type="text" id="texte" name="texte_A" required>
            <label for="paragraphes">Contenu de l'article:</label>
            <input type="text" id="paragraphes" name="paragraphes_A">
            <label for="lien">Lien WEB source:</label>
            <input type="text" id="lien" name="lien_A" required>
            <label for="image_url">Image1 de l'article:</label>
            <input type="text" id="image_url" name="image_url_A" required>
            <label for="image_url_secondaire">Image2 article:</label>
            <input type="text" id="image_url_secondaire" name="image_url_secondaire_A">
            <label for="image_url_troisieme">image3 article:</label>
            <input type="text" id="image_url_troisieme" name="image_url_troisieme_A">
           <button id="btnModifier" onclick="this.form.submit()" name="AjouterNews">Ajouter News</button>
            
        </form>
       <?php
     }


     
}
?>
