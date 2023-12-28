<?php
require_once ('template.php');

class VehiculeView extends template{
 

    public function index(){

       $this->main();
       
    }
    

    public function showVehiculeDetails($vehicule_id) {
        ?>
        
        <link rel="stylesheet" type="text/css" href="styles/vehicule.css"></link>
       <script src="js/marques.js"></script>
    </br></br></br></br>
       
    
        <?php
        
        $cf = new VehiculeController();
        $details = $cf->cars_details($vehicule_id); // récupérer les données du contrôleur (lesdetails du vehicule donné)
        ?>
        
        <?php foreach ($details as $detail): ?>
        
            <div id="vehicule-<?php echo $detail['id_vehicule']; ?>" class="vehicule-details">
    <!-- les informations détaillées du vehicule -->
    <h1>Détails du véhicule:</h1>
    <img id="vehicule-image" src="<?php echo $detail['image_vehicule']; ?>"></img>
    <table>
        <!--vehicle type -->
        <tr>
            <td><strong>Type Du Véhicule:</strong></td>
            <td><?php 
                if ($detail['type_vehicule'] == 1) {
                    echo 'Voiture';
                } elseif ($detail['type_vehicule'] == 2) {
                    echo 'Moto';
                } elseif ($detail['type_vehicule'] == 3) {
                    echo 'Camion';
                } else {
                    echo 'Inconnu';
                }
            ?></td>
        </tr>
        <tr>
            <td><strong>Marque :</strong></td>
            <td><?php echo $detail['id_marque']; ?></td>
        </tr>
        <tr>
            <td><strong>Modèle :</strong></td>
            <td><?php echo $detail['modele']; ?></td>
        </tr>
        <tr>
            <td><strong>Version :</strong></td>
            <td><?php echo $detail['version']; ?></td>
        </tr>
        <tr>
            <td><strong>Année :</strong></td>
            <td><?php echo $detail['annee']; ?></td>
        </tr>
        <tr>
            <td><strong>Dimensions:</strong></td>
            <td><?php echo $detail['dimensions']; ?></td>
        </tr>
        <tr>
            <td><strong>Consommation :</strong></td>
            <td><?php echo $detail['consommation']; ?></td>
        </tr>
        <tr>
            <td><strong>Moteur :</strong></td>
            <td><?php echo $detail['moteur']; ?></td>
        </tr>
        <tr>
            <td><strong>Performances :</strong></td>
            <td><?php echo $detail['performances']; ?></td>
        </tr>
        <tr>
            <td><strong>Tarif en DZ :</strong></td>
            <td><?php echo $detail['tarif']; ?></td>
        </tr>
         
    </table>
    <!-- fin infos AJOUTEZ NOTE  -->
</div>

        
        <?php endforeach; ?>
        
        <?php
    }
    

}

?>
