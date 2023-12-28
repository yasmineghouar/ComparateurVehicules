$(document).ready(function () {
   
    /*******************FAIRE FONCTIONNER LA DIAPORAMA D IMAGES LIENS DE PAGE ACCUEIL***************************** */
    var currentIndex = 0;
    var items = $('.diaporama-item'); //la classe appropriée aux éléments du diaporama
    var totalItems = items.length;

    function slide() {
        var item = items.eq(currentIndex);//// Sélectionne l'élément du diaporama correspondant à l'index actuel
        items.hide();// Masque tous les éléments du diaporama
        item.fadeIn(0);// Affiche l'élément actuel avec une animation de fondu temps qu'il faudra pour que l'élément passe de complètement invisible à complètement visible.
        setTimeout(nextSlide, 5000); // Planifie le passage à l'image suivante après 5 secondes
        
    }

    function nextSlide() {
        currentIndex < totalItems - 1 ? currentIndex++ : currentIndex = 0;
        slide();
    }
    
    slide();//demmarer la diapo
 
    /******************************************************************** */
   /*function getModele(marqueId) {
   
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log("ReadyState: " + this.readyState);
            console.log("Status: " + this.status);
            if (this.readyState == 4 && this.status == 200) {
                // Miseà jour la liste déroulante des modèles avec la réponse du serveur
                console.log("marqueId:", marqueId);    
         document.getElementById("modele1").innerHTML = this.responseText;
       // var models = JSON.parse(this.responseText);  
       // updateModeleDropdown(models); 
    
    
    }
        };
        xhttp.open("GET", "./Controller/AccueilController.php?action=modeles&marqueId=" + marqueId, true);//nom du fichier qui traitera la requête côté serveur
        console.log("apres open ");
        xhttp.send();
    
}
window.getModele = getModele;//// Attacher la fonction à l'objet window pour la rendre globale
  */
/*function updateModeleDropdown(models) {
    var modeleDropdown = document.getElementById("modele1");
    modeleDropdown.innerHTML = "";
    models.forEach(function(model) {
        var option = document.createElement("option");
        option.value = model['id_modele']; // Assurez-vous que votre modèle a une propriété id_modele
        option.text = model['nom_modele']; // Assurez-vous que votre modèle a une propriété nom_modele
        modeleDropdown.add(option);
    });
}
*/

function getModele(marqueId, modeleId) {
  console.log('Fonction appelée');
  console.log('marqueId envoyé :', marqueId);
  
  $.ajax({
      url: '/Tidjelabine/Controller/updateModeles.php',
      type: 'GET',
      data: {
          marque_data: marqueId   
      },
      beforeSend: function() {
          console.log('Avant la requête Ajax');
      },
      success: function(response) {
          console.log('Réponse du serveur :', response);
          $('#' + modeleId).empty();
  
          $.each(response, function(index, item) {  
           $('#' + modeleId).append('<option value="">Modele</option> ');
              $('#' + modeleId).append('<option value="'+ item.modele +'">'+ 
                  item.modele +'</option>');
          });
      },
      error: function(xhr) {
          console.log('Erreur, la requête n\'est pas entrée dans success');
          alert('Erreur ' + xhr.status); 
      }
  });
}

  


  function getVersion(modeleId, versionId) {
    console.log('Fonction appelée');
    console.log('modeleId envoyé :', modeleId);
    
    $.ajax({
        url: '/Tidjelabine/Controller/updateVersions.php',
        type: 'GET',
        data: {
            modele_data: modeleId   
        },
        beforeSend: function() {
            console.log('Avant la requête Ajax');
        },
        success: function(response) {
            console.log('Réponse du serveur :', response);
            $('#' + versionId).empty();
    
            $.each(response, function(index, item) {  
              $('#' + versionId).append('<option value="">Version</option> ');
                $('#' + versionId).append('<option value="'+ item.version +'">'+ 
                    item.version +'</option>');
            });
        },
        error: function(xhr) {
            console.log('Erreur, la requête n\'est pas entrée dans success');
            alert('Erreur ' + xhr.status); 
        }
    });
  }



  function getAnnee(versionId, anneeId) {
    console.log('Fonction appelée');
    console.log('versionId envoyé :', versionId);
    
    $.ajax({
        url: '/Tidjelabine/Controller/updateAnnee.php',
        type: 'GET',
        data: {
            version_data: versionId   
        },
        beforeSend: function() {
            console.log('Avant la requête Ajax');
        },
        success: function(response) {
            console.log('Réponse du serveur :', response);
            $('#' + anneeId).empty();
    
            $.each(response, function(index, item) {  
              $('#' + anneeId).append('option value="">Annee</option> ');
                $('#' + anneeId).append('<option value="'+ item.annee +'">'+ 
                    item.annee +'</option>');
            });
        },
        error: function(xhr) {
            console.log('Erreur, la requête n\'est pas entrée dans success');
            alert('Erreur ' + xhr.status); 
        }
    });
  }
  window.getModele = getModele;//// Attacher la fonction à l'objet window pour la rendre globale
    window.getVersion = getVersion;//// Attacher la fonction à l'objet window pour la rendre globale
    window.getAnnee = getAnnee;


/**REQUETE GET POUR L ENVOIS DES 4 FORMULAIRES DE COMPARAISONS */
    $("#Comparer").on("click", function () {
        // Recuperer les données de chaque formulaire
        var formData1 = $("#form1").serialize();
        var formData2 = $("#form2").serialize();
        var formData3 = $("#form3").serialize();
        var formData4 = $("#form4").serialize();

        // Fusionner les données de tous les formulaires
        var allFormData = formData1 + "&" + formData2 + "&" + formData3 + "&" + formData4;
        console.log(allFormData);
        // Envoyer la requete AJAX avec les données combinés
        $.ajax({
            url: '/Tidjelabine/TraitementFormulaire', //  traitement côté serveur
            type: 'POST', // Utilisez la méthode POST pour envoyer les données
            data: allFormData,
            success: function (response) {
                // Traitez la réponse si nécessaire
                console.log('Réponse du serveur :', response);//envoyer le resultat de la requete vers la nouvelle page comparateur
                window.location.href = "/Tidjelabine/Controller/TraitementListe.php?" + allFormData;
                
            },
            error: function (xhr) {
                console.log('Erreur, la requête n\'est pas entrée dans success');
                alert('Erreur ' + xhr.status);
            }
        });

        console.log('Cliquéeeeeeeeeeeeeeeeeeeeeeee');
        //window.location.href = "/Tidjelabine/TraitementFormulaire";
    });


   /* $("#Comparer").on("click", function () {
       
        $("#form1").submit();
        
    
    console.log('cliquéeeeeeeeeeeeeeeeeeeeeeee');
});*/
  /*  $("#Comparer").on("click", function () {
    $(".formulaire").each(function(){
        var fd = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "/Tidjelabine/Controller/AccueilController.php?action=/Tidjelabine/TraitementFormulaire",

            data: fd,
            processData: false,
            contentType: false,
            success: function(data,status) {
               //this will execute when form is submited without errors
              // window.location.href = "/Tidjelabine/TraitementFormulaire";
           },
           error: function(data, status) {
               //this will execute when get any error
           },
       });
    });
});*/
  
   
   
    
    
   

  
    

});

   