<?php
require_once ('template.php');

class UserProfilView extends template{ //page utilisateur


    public function index(){

        $this->main();
         $this->show_user_details();
         $this->show_footer();
         
      
        

     }
     public function show_user_details(){
        
        $user_id = $_SESSION["user"];//s'il est user on utilise la variable session pour recupeeerer l'id
        
        $usercf = new UserProfilController();
        $vehiculesFav=$usercf->getFavorisDetails($user_id);//recuperer les vehicules favoris du user
        $resNomPre=$usercf->getUserNomPrenom($user_id);//recuperer son nom et son prenom
        $infoUser=$usercf->getUserInfo($user_id);//recuperer les infos de l'utilisateur
        $mail=$infoUser[0]['email'];
        $genre=$infoUser[0]['sexe'];
        $date=$infoUser[0]['date_naissance'];
        $nom= $resNomPre[0]['nom'];
        $prenom= $resNomPre[0]['prenom'];
        ?>
        <link rel="stylesheet" type="text/css" href="styles/user.css">
        <script src="js/marques.js"></script>
        <div class="bienvenu-container"> 
        <h1>Bienvenue <?php echo $prenom . ' ' . $nom; ?> !</h1>
        
        <div class="user-info-table">
        <table>
            <tr>
                <td>Sexe:</td>
                <td><?php echo ($genre === 'M') ? 'Masculin' : 'Féminin'; ?></td>
            </tr>
            <tr>
                <td>Date de naissance:</td>
                <td><?php echo date('d-m-Y', strtotime($date)); ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $mail; ?></td>
            </tr>
        </table>
    </div>
</div>
         <div class="profile-container">
        <h3>Voici vos voitures favorites :</h3>
        
        <div class="profile-details">
            
           
           <?php foreach ($vehiculesFav as $vehiculeFav): ?>
            <div class="car-item">
            <div id="cliqueFav" data-vehicle-id="<?php echo $vehiculeFav['id_vehicule']; ?>">
              <img style="cursor:pointer;" src="<?php echo $vehiculeFav['image_vehicule']; ?>">
            </div>
                    <h2><?php echo $vehiculeFav['modele']; ?></h2>
                    
        <?php
        $cf = new VehiculeController();
        $marque_vehicule = $cf->get_marque_vehicule($vehiculeFav['id_vehicule']);//récupèrer le nom de la marque
        $nom_marque_vehicule= $marque_vehicule[0]['nom_marque'];
        
        ?>
                    <p>Marque : <?php echo $nom_marque_vehicule; ?></p>
                    <p>Version : <?php echo $vehiculeFav['version']; ?></p>
                    <p>Année : <?php echo $vehiculeFav['annee']; ?></p>
                
                </div>
                <form action="/Tidjelabine/TraitementListe" method="post"><input name="vehiculeId" value="<?php echo $vehiculeFav['id_vehicule'] ?>" hidden ><button style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #c5a173; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="this.form.submit()">Plus de détails</button></form>
         <?php endforeach; ?>
            
            
        

         </div>  
         
        
    </div>
    <div id="styled-div">
    <a  href="/Tidjelabine/Marques">Voulez-vous noter des véhicules ? Cliquez ici pour accéder aux marques disponibles !</a>
</div>


        <?php
     }

     public function show_user_details_for_admin($vehiculesFav,$resNomPre){//fct qui permet d'afficher la page profil d'un user à l'administrateur
        $nom= $resNomPre[0]['nom'];
        $prenom= $resNomPre[0]['prenom'];
        
        ?>
        <link rel="stylesheet" type="text/css" href="../styles/user.css">
        <script src="../js/marques.js"></script>
        <div class="bienvenu-container"> 
        <h1>Vous etes sur la page de :<?php echo $prenom . ' ' . $nom; ?> !</h1>
        </div>
         <div class="profile-container">
        <h3>Voici ses voitures favoris :</h3>
        
        <div class="profile-details">
            
           
           <?php foreach ($vehiculesFav as $vehiculeFav): ?>
            <div class="car-item">
            <div id="cliqueFav" data-vehicle-id="<?php echo $vehiculeFav['id_vehicule']; ?>">
              <img style="cursor:pointer;" src="../<?php echo $vehiculeFav['image_vehicule']; ?>">
            </div>
                    <h2><?php echo $vehiculeFav['modele']; ?></h2>
                    
      
                    <p>Marque : <?php echo $vehiculeFav['id_marque'];; ?></p>
                    <p>Version : <?php echo $vehiculeFav['version']; ?></p>
                    <p>Année : <?php echo $vehiculeFav['annee']; ?></p>
                
                </div>
                <form action="/Tidjelabine/TraitementListe" method="post"><input name="vehiculeId" value="<?php echo $vehiculeFav['id_vehicule'] ?>" hidden ><button style="margin-top: 10px; cursor: pointer; padding: 8px 16px; background-color: #c5a173; color: #fff; border: none; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onclick="this.form.submit()">Plus de détails</button></form>
         <?php endforeach; ?>
            
            
        

         </div>  
         
        
    </div>
    <div id="styled-div">
    <a  href="/Tidjelabine/Marques">Voulez-vous noter des véhicules ? Cliquez ici pour accéder aux marques disponibles !</a>
</div>

     <?php
     }

    
}
?>
