<?php
require_once ('template.php');

class AdminParametreView extends template{


    public function index(){

        $this->main();
        $this->show_parametres_contact();
        $this->show_parametres_guide();
        $this->show_diaporama_news_gestion();
        $this->show_diaporama_pubs_gestion();
        $this->show_footer();
     }

     public function show_parametres_contact(){
     //cette fct affiche le tableau pour gerer les informations du contact 
        ?>
        <link rel="stylesheet" type="text/css" href="styles/admin.css">
  
       <script src="js/admin.js"></script>
         <?php
        $cf =  new ContactController();
        $contactInfos = $cf->ContactInfos();//récupèrer les données du controleur(les infos contact du site)
        ?>
        <div style="height: 20px;"></div>
          <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les informations Contact</h1>
     
          <section class="container">
        <div class="row">
            <div class="col-12">
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
          <thead><tr><th>Adresse</th><th>Email Contact</th><th>Téléphone Contact</th><th>Description</th><th>Gestion</th></tr></thead>
          <tbody>
          <?php foreach($contactInfos as $contactInfo):?>
          <tr>
            
            <td><?php echo $contactInfo['adresse']; ?></td>
            <td><?php echo $contactInfo['email_contact']; ?></td>
            <td><?php echo $contactInfo['telephone_contact']; ?></td>
            <td><?php echo $contactInfo['description']; ?></td>
            
            <td> <a style="cursor: pointer;" onclick="affFormModContact('<?php echo $contactInfo['adresse']; ?>', '<?php echo $contactInfo['email_contact']; ?>', '<?php echo $contactInfo['telephone_contact']; ?>', '<?php echo $contactInfo['description']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
          </tr>
          
          <?php endforeach;?>
          </table>
             </div>
        </div>
    </section>
  
          <!-- formulaire de modification Contact-->
        <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="formModContact" style="display: none;">
             <label for="id_contact" hidden>id Contact:</label>
            <input type="number" id="id_contact" name="id_contact" hidden>
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse">
            <label for="email_contact">Email de contact :</label>
            <input type="email" id="email_contact" name="email_contact">
            <label for="telephone_contact">N° de Téléphone :</label>
            <input type="text" id="telephone_contact" name="telephone_contact">
            <label for="description">Desciption du Site :</label>
            <input type="text" id="description" name="description">
            
           <button id="btnModifier" onclick="this.form.submit()" name="modifierMarque">Modifier Contact</button>
            
        </form>
       
       <?php
     }
    
     public function show_parametres_guide(){
        //cette fct affiche le tableau pour gerer les informations du guide 
           ?>
           <link rel="stylesheet" type="text/css" href="styles/admin.css">
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- Insérer cette balise "link" après celle de Bootstrap -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<!-- Insérer cette balise "script" après celle de Bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

          <script src="js/admin.js"></script>
            <?php
           $cf =  new GuideAchatController();
           $conseils = $cf->getGuideAchat();//récupèrer les données du controleur(les infos guide achat)
           ?>
           <div style="height: 20px;"></div>
             <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Les informations Guide</h1>
             
             <section class="container">
        <div class="row">
            <div class="col-12">
            <a style="cursor: pointer;" onclick="affAjFormGuide()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
             <thead><tr><th data-sortable="true" data-field="nom" data-searchable="true">Conseils Achat d'un Véhicule</th><th>Gestion</th></tr></thead>
             <tbody>
             <?php foreach($conseils as $conseil):?>
             <tr>
               
               <td><?php echo $conseil['guide']; ?></td>
              
               
               <td>       <!--lien de suppression et modificcation guide-->
            <a href="/Tidjelabine/Controller/apiroute.php?guideIdS=<?php echo $conseil['id_guide']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
            <a style="cursor: pointer;" onclick="affFormModGuide(<?php echo $conseil['id_guide']; ?>, '<?php echo $conseil['guide']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
             </tr>
             
             <?php endforeach;?>
             </table>
             </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

     
             <!-- formulaire de modification Guide-->
           <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="formModGuide" style="display: none;">
           <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification Guide</span> 
                <label for="id_guide" hidden></label>
               <input type="number" id="id_guide" name="id_guide" hidden>
               <label for="guide">Guide :</label>
               <input type="text" id="guide" name="guide">
               
               
               
              <button id="btnModifier" onclick="this.form.submit()" name="modifierGuide">Modifier le Guide</button>
               
           </form>   <!-- formulaire d'ajout 'Guide-->
           <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="formAjGuide" style="display: none;">
           <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout Guide</span> 
                <label for="id_guide" hidden></label>
               <input type="number" id="id_guide" name="id_guide_A" hidden>
               <label for="guide">Guide :</label>
               <input type="text" id="guide" name="guide_A">
               
               
               
              <button id="btnModifier" onclick="this.form.submit()" name="AjouterGuide">Ajouter au Guide</button>
               
           </form>
          
          
          <?php
        }

        public function show_diaporama_news_gestion(){
          //cette fct affiche le tableau pour gerer les informations du  diaporama des news+ celui des publicités
             ?>
             <link rel="stylesheet" type="text/css" href="styles/admin.css">
            <script src="js/admin.js"></script>
              <?php
             $cf =  new NewsController();
             $articles = $cf->news();//récupèrer les données du controleur ( images et liens diapo)
             ?>
             <div style="height: 20px;"></div>
               <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Diaporama :Les Liens et Images News</h1>
           <!--lien pour ajouter des news-->
           
           <section class="container">
        <div class="row">
            <div class="col-12">
            <a style="cursor: pointer;" onclick="afficherAjoutNewsDiapo()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
               
               <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID article</th><th>Image News</th><th data-searchable="true">Lien News</th><th>Gestion</th></tr></thead>
               <tbody>
               <?php foreach($articles as $article):?>
               <tr>
                 
               <td> <?php echo $article['id_news']; ?></td>
               <td><img style ="width:200px; height:200px" src=<?php echo $article['image_url']; ?>></td>
               <td> <a href="<?php echo $article['lien']; ?>"> <?php echo $article['lien']; ?></a> </td>
                  
           
                 <td>
                    <!--lien de suppression news-->
            <a href="/Tidjelabine/Controller/apiroute.php?newsIdDiapoS=<?php echo $article['id_news']; ?>&diapo=1"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
             <!--lien de modification news-->
            <a style="cursor: pointer;" onclick="afficherModificationNewsDiapo(<?php echo $article['id_news']; ?>, '<?php echo $article['lien']; ?>', '<?php echo $article['image_url']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a></td>
               </tr>
               
               <?php endforeach;?>
               </table>
             </div>
        </div>
    </section>
              <!-- formulaire de modification News (image et lien seulement)-->
        <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="upFrmNewsDiapo" style="display: none;">
        <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification NewsDiapo</span> 
             <label for="id_news" hidden> </label>
            <input type="number" id="id_news" name="id_newsDiapo_modifier" hidden>
            <label for="titre" hidden>Titre de l'article:</label>
            <input type="text" id="titre" name="titre_modifier" hidden>
            <label for="texte" hidden>texte de l'article:</label>
            <input type="text" id="texte" name="texte_modifier" hidden>
            <label for="paragraphes" hidden>Contenu de l'article:</label>
            <input type="text" id="paragraphes" name="paragraphes_modifier" hidden>
            <label for="lien">Lien WEB source:</label>
            <input type="text" id="lien" name="lien_modifier">
            <label for="image_url">Image1 de l'article:</label>
            <input type="text" id="image_url" name="image_url_modifier">
            <label for="image_url_secondaire" hidden>Image2 article:</label>
            <input type="text" id="image_url_secondaire" name="image_url_secondaire_modifier" hidden>
            <label for="image_url_troisieme" hidden>image3 article:</label>
            <input type="text" id="image_url_troisieme" name="image_url_troisieme_modifier" hidden>
           <button id="btnModifier" onclick="this.form.submit()" name="modifierMarque">Modifier image et lien News</button>
            
        </form>
          <!-- formulaire d'ajouter un article news ( image et lien seulement)-->
          <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="FormAjNewsDiapo" style="display: none;">
          <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout NewsDiapo</span> 
         <label for="id_news" hidden>id news:</label>
            <input type="number" id="id_news" name="id_newsDiapo_A" hidden>
            <label for="titre" hidden>Titre de l'article:</label>
            <input type="text" id="titre" name="titre_A" hidden>
            <label for="texte" hidden>texte de l'article:</label>
            <input type="text" id="texte" name="texte_A" hidden>
            <label for="paragraphes" hidden>Contenu de l'article:</label>
            <input type="text" id="paragraphes" name="paragraphes_A" hidden>
            <label for="lien">Lien WEB source:</label>
            <input type="text" id="lien" name="lien_A" required>
            <label for="image_url">Image1 de l'article:</label>
            <input type="text" id="image_url" name="image_url_A" required>
            <label for="image_url_secondaire" hidden>Image2 article:</label>
            <input type="text" id="image_url_secondaire" name="image_url_secondaire_A" hidden>
            <label for="image_url_troisieme" hidden>image3 article:</label>
            <input type="text" id="image_url_troisieme" name="image_url_troisieme_A" hidden>
           <button id="btnModifier" onclick="this.form.submit()" name="AjouterNews">Ajouter image et lien News</button>
            
        </form>
            
            <?php
          }

          public function show_diaporama_pubs_gestion(){
            //cette fct affiche le tableau pour gerer les informations du  diaporama :celui des publicités
               ?>
               <link rel="stylesheet" type="text/css" href="styles/admin.css">
              <script src="js/admin.js"></script>
                <?php
               $cf =  new AdminParametreController();
               $articles = $cf->get_pubs();//récupèrer les données du controleur ( images et liens pub)
               ?>
               <div style="height: 20px;"></div>
                 <h1 style="color: #5d492d; font-size: 32px; text-align: center;">Diaporama :Les Liens et Images des publicités </h1>
             <!--lien pour ajouter des pub-->
            
             <section class="container">
        <div class="row">
            <div class="col-12">
            <a style="cursor: pointer;" onclick="afficherAjoutPubDiapo()"><img src="images/ajouter-bouton.png" width="22" height="22"></a>
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
                 <thead><tr><th data-sortable="true" data-field="id" data-searchable="true">ID Publicité</th><th>Image Publicité</th><th>Lien Publicité</th><th>Gestion</th></tr></thead>
                 <tbody>
                 <?php foreach($articles as $article):?>
                 <tr>
                   
                 <td> <?php echo $article['id_publicite']; ?></td>
                 <td><img style ="width:200px; height:200px" src=<?php echo $article['image_url']; ?>></td>
                 <td><a href="<?php echo $article['lien']; ?>"> <?php echo $article['lien']; ?></a></td>
                    
             
                   <td>
                      <!--lien de suppression pubs-->
              <a href="/Tidjelabine/Controller/apiroute.php?pubIdDiapoS=<?php echo $article['id_publicite']; ?>"><img src="images/bouton-supprimer.png" width="20" height="20"></a> 
               <!--lien de modification news-->
              <a style="cursor: pointer;" onclick="afficherModificationPubDiapo(<?php echo $article['id_publicite']; ?>, '<?php echo $article['lien']; ?>', '<?php echo $article['image_url']; ?>')"><img src="images/bouton-modifier.png" width="20" height="20"></a>
            </td>
                 </tr>
                 
                 <?php endforeach;?>
                 </table>
             </div>
        </div>
    </section>

               <!-- Formulaire de modification de publicité (image et lien seulement) -->
     <form action="/Tidjelabine/Controller/apiroute.php" method="post" id="upFrmPubDiapo" style="display: none;" hidden>
     <span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Modification Pub</span> 
    <label for="id_publicite" hidden></label>
    <input type="number" id="id_publicite" name="id_publicite_modifier" hidden>
    
   
    <label for="lien">Lien WEB source:</label>
    <input type="text" id="lien_pub" name="lien_pub_modifier">
    
    <label for="image_url">Image de la publicité:</label>
    <input type="text" id="image_url_pub" name="image_pub_url_modifier">
    

    
    <button id="btnModifier" onclick="this.form.submit()" name="modifierPublicite">Modifier image et lien Publicité</button>
      </form>

              
          <!-- Formulaire d'ajout de publicité (image et lien seulement) -->
<form action="/Tidjelabine/Controller/apiroute.php" method="post" id="addFrmPubDiapo" hidden>
<span style="display: block; font-size: 18px; font-weight: bold;  color: #cf0015; margin-bottom: 15px;"> Formulaire Ajout Pub</span> 
<label for="id_publicite" hidden>Id Pub:</label>
    <input type="number" id="id_publicite" name="id_publicite_A" hidden>
    <label for="lien">Lien WEB source:</label>
    <input type="text" id="lien" name="lien_ajout">
    
    <label for="image_url">Image de la publicité:</label>
    <input type="text" id="image_url" name="image_url_ajout">
    
    
    <button id="btnAjouter" onclick="this.form.submit()" name="ajouterPublicite">Ajouter image et lien Publicité</button>
</form>

              
              <?php
            }
     
}
?>
