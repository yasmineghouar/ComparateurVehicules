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

function getModele(marqueId, modeleId) {//recuperer les modeles a partir d une marque et l afficher dan sle shamps suivant
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
          $('#' + modeleId).append('<option value="">Modele</option> ');
          $.each(response, function(index, item) {  //pr chaque modele l'ajouter danns la liste en utlisant apend
          // $('#' + modeleId).append('<option value="">Modele</option> ');
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
            $('#' + versionId).append('<option value="">Version</option> ');
            $.each(response, function(index, item) {  
            // $('#' + versionId).append('<option value="">Version</option> ');
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
            $('#' + anneeId).append('option value="">Annee</option> ');
            $.each(response, function(index, item) {  
             //$('#' + anneeId).append('option value="">Annee</option> ');
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
            //verifier avant d'envoyer les donnes dans la requete ajax si 2 forms complets min sont envoyés
            if(!verifierFormulairesIdentiques()){//verifier si ya pas 2 vehicules identiques dans les formulaires
                alert("Veuillez ne pas comparer des vehicules identiques!");
                
                
                return;
            }
            if (!validateForm()) {
            alert("Veuillez remplir au moins 2  formulaires, dans chaque formulaire veuillez insérer les 4 champs!");
            
            return;
        }
        
        // Recuperer les données de chaque formulaire
        var formData1 = $("#form1").serialize();//cette fct retourne les champs remplis avec &( nomchamps=valeurschamps&.....)
        var formData2 = $("#form2").serialize();
        var formData3 = $("#form3").serialize();
        var formData4 = $("#form4").serialize();
            if(formData4=="marque4=&modele4=&version4=&annee4="){//le formulaire 4 est vide
                console.log("formData4== numm");
               
            }
            if(formData3=="marque3=&modele3=&version3=&annee3="){//le formulaire 4 est vide
                console.log("formData3== numm");
               
            }
        // Fusionner les données de tous les formulaires
        var allFormData = formData1 + "&" + formData2 + "&" + formData3 + "&" + formData4;
        console.log(allFormData);
        // Envoyer la requete AJAX avec les données combinés
        $.ajax({
            url: '/Tidjelabine/TraitementFormulaire', //  traitement côté serveur AcceuilController-->methode traitement formulaire
            type: 'POST', 
            data: allFormData,
            success: function (response) {
                //les envoyer a cceuilController-->methode traitement formulaire pour utiliser la reponse et linstruction window.location.href
                console.log('Réponse du serveur :', response);//envoyer le resultat sous forme de la requete vers la nouvelle page comparateur
                window.location.href = "/Tidjelabine/Controller/TraitementListe.php?" + allFormData;
                
            },
            error: function (xhr) {
                console.log('Erreuur, la requête n\'est pas entrrée dans successs');
                alert('Erreur ' + xhr.status);
            }
        });

        console.log('Cliquéeeeeeeeeeeeeeeeeeeeeeee');
        //window.location.href = "/Tidjelabine/TraitementFormulaire";
    });
//cette fct guarantit: au moins 2 formulaires parmi les 4 se remplissent , et si un formulaire est rempli les 4 champs doivent etres remplits
   
        /** */
        function validateForm() {
            // Compteur pour suivre le nombre de formulaires remplis
            var filledFormsCount = 0;
            
            // Vérifier si tous les champs du formulaire sont remplis
    
            for (var numero = 1; numero <= 4; numero++) {//numero pour iterer les 4 formulaires
                var isValid = true;
            $("#form" + numero + " :input").each(function () {
                if ($(this).val() === "") {
                    isValid = false;
                    return false; // Sortir de la boucle dès qu'un champ non rempli est trouvé dans le formulaire #formId
                }
            });
        
            // Si tous les champs d'1 formulaire form sont remplis, incrémenter le compteur ( +1form remplit successfully)
            if (isValid) {
                filledFormsCount++;
            }
            }
            // Vérifier si au moins deux formulaires parmi les quatre sont remplis
            if (filledFormsCount >= 2) {
                return true;
            } else {
                console.log("Veuillez remplir au moins deux formulaires parmi les quatre.");
                return false;
            }
        }
        function verifierFormulairesIdentiques() {
            // Parcourir chaque formulaire
            for (var i = 1; i <= 4; i++) {
                // Récupérer les valeurs des champs du formulaire actuel
                var marqueActuelle = $('#marque' + i).val();
                var modeleActuel = $('#modele' + i).val();
                var versionActuelle = $('#version' + i).val();
                var anneeActuelle = $('#annee' + i).val();

                // Vérifier parmi les autres formulaires
                for (var j = 1; j <= 4; j++) {
                    if (i !== j) {
                        // Comparer les valeurs
                        if (
                            marqueActuelle === $('#marque' + j).val() &&
                            modeleActuel === $('#modele' + j).val() &&
                            versionActuelle === $('#version' + j).val() &&
                            anneeActuelle === $('#annee' + j).val()
                        ) {
                            
                            return false; // Sortir de la fonction dès qu'une correspondance est trouvée
                        }else{
                            return true;
                        }
                    
                    }
                }
            }

            // Si aucune correspondance n'est trouvée, afficher un message ou effectuer d'autres actions
            alert('Aucun formulaire identique détecté.');
        }
    
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

   