$(document).ready(function () {
    
    $('#marques-details-container').hide();//cacher par defaut le conteneur des details de la marque



    $('.marques-scroll').click(function () {//faire defiler lors du clique sur la marque vers le bas pour afficher les details
        var containerOffset = $('#Bzone1').offset().top + $('#Bzone1').height();//obtenir la distance entre le haut de la page et le début du conteneur Bzone1
        
        $('html, body').animate({scrollTop: containerOffset}, 'fast');

        var marqueId = $(this).data('id');// récupérer le id de la marque depuis l'attribut data-id
        var marqueName = $(this).data('marque'); // récupérer le nom de la marque depuis l'attribut data-marque
        $('#marques-details-container').hide();//cacher par defaut le conteneur des details de la marque
   // Effectuer une requête AJAX vers la même page PHP
      $.ajax({
       type: 'POST',
       url: '/Tidjelabine/Controller/Clique_Marques.php', // le nom de fichier PHP
      data: {id: marqueId, marque: marqueName},
    success: function (response) {
        // Mettre à jour le contenu de la div 'marque-details-container' avec les détails de la marque
       // $('#marques-details-container').html(response);
       
       
       console.log(response);
       //$('#marques-details-container').empty();
       //$('#marques-details-container').html(response); 
       $('#marques-details-container').fadeIn();
       //location.reload();
        //console.log(response);
       // $('#marques-details-container').html(response);
    },
    error: function () {
        console.log('Erreur lors de la récupération des détails de la marque.');
    }
     });
       
       /* $('#marques-details-container').text('Nom de la marque: ' + marqueName);*/
        return false;
    });


    //traiter la liste droulante des vehicules
    $('#carSelect').on('change', function () {
        var vehiculeId = $(this).val();
         console.log(vehiculeId);
        // Perform the AJAX request
        $.ajax({
            type: 'POST',
            url: '/Tidjelabine/Controller/TraitementListe.php', 
            data: { vehiculeId: vehiculeId },
            success: function (response) {
                console.log('Réponse du serveuuuuuuuuur :', response);
               // window.location.href = '/Tidjelabine/TraitementListe';
                
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
    $('#vehicule-image').click(function() {
        // Récupérer la valeur spécifique de l'attribut data-value de l'image cliquée
        var selectedValue = $(this).data('value');//recuperer l'id du vehicule que porte l'image a partir de l'attriubue data-value
        console.log(selectedValue);
        // Définir la valeur dans le champ select
        $('#carSelect').val(selectedValue);
        console.log("image cliqué");
        // Soumettre le formulaire
        $.ajax({
            type: 'POST',
            url: '/Tidjelabine/TraitementListe2', 
            data: { vehiculeId: selectedValue },
            success: function (response) {
                //console.log('Réponse du serveuuuuuuuuur :', response);
                window.location.href = '/Tidjelabine/TraitementListe';
                
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
        $('#FormCar').submit();
        console.log("envoyé");
       
    });
   

});

