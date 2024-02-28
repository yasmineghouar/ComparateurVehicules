<?php
require_once ('template.php');

class AdminUserView extends template{


    public function index(){

        $this->main();
        $this->show();
        $this->show_footer();
        

     }


     public function show()//afficher gestion utilisateur
     {
         ?>
         <link rel="stylesheet" type="text/css" href="styles/admin.css">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
               integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
               crossorigin="anonymous">
         <!-- Insérer cette balise "link" après celle de Bootstrap -->
         <link rel="stylesheet"
               href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
 
         <!-- Insérer cette balise "script" après celle de Bootstrap -->
         <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
         <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
         <script src="js/admin.js"></script>
         <script>
             $(document).ready(function () {
                 $('#table').bootstrapTable({
                     filterControl: true, 
                     
                     filterOptions: {
                         filterAlgorithm: 'and', 
                        
                         sexe: $.fn.bootstrapTable.filterData.sexe
                     }
                 });
 
                 $.fn.bootstrapTable.filterData.sexe = function (text, target, searchKey) {
                     return text.toLowerCase() === searchKey.toLowerCase();
                 };
 
                 // Trigger the filter control change event
                 $('#table').on('column-search.bs.table', function (e, column, value) {
                     if (column.field === 'sexe') {
                         $('#table').bootstrapTable('filterBy', {
                             sexe: value
                         });
                     }
                 });
             });
         </script>
        <?php
        $cf =  new AdminUserController();
        $users = $cf->get_all_users();//récupèrer les données du controleur(les users)
        ?>
       <section class="container">
        <div class="row">
            <div class="col-12">
            <table id="table" class="table" data-toggle="table" data-search="true" data-filter-control="true"  data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
         
                    <thead>
                        <tr>
                        <th data-sortable="true" data-field="id" data-searchable="true">ID</th><th data-sortable="true" data-field="nom" data-searchable="true">Nom</th><th data-sortable="true" data-field="prenom">Prenom</th><th data-sortable="true" data-field="sexe" data-filter-control="select">Sexe</th><th data-sortable="true" data-field="date" data-searchable="true">Date de naissance</th><th>Email</th><th data-sortable="true" data-field="valide" data-searchable="true">inscription validée</th><th data-sortable="true" data-field="bloque" data-searchable="true">User bloqué</th><th>Gestion</th>
                           
                        </tr>
                    </thead>
                    <tbody>
          <?php foreach($users as $user):?>
          <tr>
            <td><?php echo $user['id_utilisateur']; ?></td>
            <td><?php echo $user['nom']; ?></td>
            <td><?php echo $user['prenom']; ?></td>
            <td><?php echo $user['sexe']; ?></td>
            <td><?php echo $user['date_naissance']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo ($user['est_inscrit'] == 0) ? 'inscription non validée' : 'inscription validée '; ?></td>
            <td><?php echo ($user['est_bloque'] == 0) ? 'non bloqué' : 'bloqué'; ?></td>
            <td><a href="/Tidjelabine/Controller/apiroute.php?userIdS=<?php echo $user['id_utilisateur']; ?>"><img src="images/bloquer-un-utilisateur.png" width="24" height="24"></a>     <a href="/Tidjelabine/Controller/apiroute.php?userIdV=<?php echo $user['id_utilisateur']; ?>"><img src="images/jaccepte.png" width="24" height="24"></a>   <a href="/Tidjelabine/Controller/apiroute.php?ProfileUser=<?php echo $user['id_utilisateur']; ?>"><img src="images/pere.png" width="24" height="24"></a></td>
          </tr>
          
          <?php endforeach;?>
          </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

      


     <?php
}


     
}
?>
