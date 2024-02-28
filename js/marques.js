$(document).ready(function () {
    
    $('#marques-details-container').hide();//cacher par defaut le conteneur des details de la marque
  //page vehicule clique sur afficher tous les avis
  $("#afficherAvis").click(function(e) {
    e.preventDefault(); // Empêcher le lien de suivre le chemin du lien normal

    // Afficher ou masquer la liste d'avis avec une animation de fondu
    $("#tousAvis").fadeToggle();
   // $("#tousAvis").fadeToggle(3000); 
    console.log('Display:', $("#tousAvis").css('display'));
   });
   
   //page vehicule clique sur afficher tous les avis
   $("#afficherAvisVehic").click(function(e) {
    e.preventDefault(); // Empêcher le lien de suivre le chemin du lien normal

    // Afficher ou masquer la liste d'avis avec une animation de fondu
    $("#tousAvisVehic").fadeToggle();
    
    console.log('Display:', $("#tousAvis").css('display'));
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
 
    function submitFormMarquesAvis(idAvisClique,idUserClk) {//fonction qui envoit la requete post en ajax pr apprecier un avis sur une marque 
        
       
     //recuperer l'id du comm liké et le user qui la liké puis envoyer une requete ajax post pour effectuer l'appreciation en model 
     //et recuperer le nv nbre d'appreciation pr l'afficher sans raffraichir la page
       $.ajax({
             type: 'POST',
             url: '/Tidjelabine/ShowDetailsMarque', 
             data: {
                 avisFavMrk: idAvisClique,
                 idUserClk:idUserClk
   },
             success: function(response) {
                 // Meiisela section des avis avec la réponse du serveur
             console.log(response);
             console.log('#avis-nbr'+idAvisClique);

             $('#avis-nbr'+idAvisClique).html(response);//changer le nbre d'appreciation du commentaire sans raffarichir la page.
             },
             error: function(error) {
                 console.log(error);
             }
         });
        // Soumettre le formulaire
     // form.submit();
        }
window.submitFormMarquesAvis=submitFormMarquesAvis;


function submitFormAvisV(idAvisClique,idUserClk) {//fonction qui envoit la requete post en ajax pr apprecier un avis sur un vehicule 

   // recuperer le formulaire en haut par son id
   var form = document.getElementById('hiddenFormMrkk');
   $.ajax({
         type: 'POST',
         url: '/Tidjelabine/LikeAvisVehc', 
         data: {
            
            avisFav: idAvisClique,
            userLike:idUserClk
            },
         success: function(response) {
             // Meiisela section des avis avec la réponse du serveur
         console.log(response);
         console.log('#avisLike'+idAvisClique);

         $('.avisLike'+idAvisClique).html(response);//changer le nbre d'appreciation du commentaire sans raffarichir la page.
         },
         error: function(error) {
             console.log(error);
         }
     });
    // Soumettre le formulaire
 // form.submit();
    }
window.submitFormAvisV=submitFormAvisV;
/*
    $('.marques-scroll').click(function () {
       
        console.log("rafrraciheeeeeeeeeeeeeeeeeee");
        //faire defiler lors du clique sur la marque vers le bas pour afficher les details
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
       $('#marques-details-container').fadeIn();// Mettre à jour le contenu de la div 'marque-details-container' avec les détails de la marque
      
       //location.reload();
        //console.log(response);
       // $('#marques-details-container').html(response);
    },
    error: function () {
        console.log('Erreur lors de la récupération des détails de la marque.');
    }
     });
     
       /* $('#marques-details-container').text('Nom de la marque: ' + marqueName);*/
      /*  return false;
    });
*/

   
  /* var offset = 5; // Initial offset for loading more reviews

$("#loadMoreButton").click(function() {
    console.log("loadMoreButton");
    $.ajax({
        url: "/Tidjelabine/Controller/Clique_Marques.php",
        type: "GET",
        data: { offset: offset },
        success: function(response) {
            console.log(response);
            $("#tousAvis ul").append(response);
            offset += 5; // Increase the offset for the next batch of reviews
        },
        error: function(xhr, status, error) {
            console.error("Error loading more avis: " + error);
        }
    });
});*/

});

