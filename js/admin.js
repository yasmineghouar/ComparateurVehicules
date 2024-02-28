$(document).ready(function () {


 function afficherFormulaireModification(id_marque, nom_marque, pays_origine, siege_social, annee_creation, lien_marque, image_marque) {
      // les champs du formulaire sont preremplit avec les données de la marque existants dans la bdd
      console.log(' afficherFormulaireModification appellee');
      $('#id_marque').val(id_marque);
      $('#nom_marque').val(nom_marque);
      $('#pays_origine').val(pays_origine);
      $('#siege_social').val(siege_social);
      $('#annee_creation').val(annee_creation);
      $('#lien_marque').val(lien_marque);
      $('#image_marque').val(image_marque);
      
   
      // Afficheage  formulaire de modification
      $('#modifierForm').show();
   }
   window.afficherFormulaireModification = afficherFormulaireModification;//// Attacher la fonction à l'objet window pour la rendre globale

  //MODIFIER UN VEHICULE
   function afficherFormulaireModificationVehicule(id_vehicule,id_marque,modele,version,annee, dimensions, consommation, moteur, performances,couleur,type_vehicule, tarif, image_vehicule, capacite_moteur, poids, capacite_reservoir, vitesse_max, style, type_carburant, transmission, nombre_portes, nombre_places){
    console.log(' afficherFormulaireModification  VEHICULE appellee');
    
    $('#id_vehicule').val(id_vehicule);
    //supprimer le select option par defaut
    $('#nom_marque option').prop('selected', false);
    // Définir la valeur de la marque
    $('#nom_marque').val(id_marque);

    // Trouver l'option correspondante et la définir comme sélectionnée
    $('#nom_marque option[value="' + id_marque + '"]').prop('selected', true);
    
    $('#modele').val(modele);
    $('#version').val(version);
    $('#annee').val(annee);
    $('#dimensions').val(dimensions);
    $('#consommation').val(consommation);
    $('#moteur').val(moteur);
    $('#performances').val(performances);
    $('#couleur').val(couleur);
    $('#type_vehicule').val(type_vehicule);
    $('#tarif').val(tarif);
    $('#image_vehicule').val(image_vehicule);
    $('#capacite_moteur').val(capacite_moteur);
    $('#poids').val(poids);
    $('#capacite_reservoir').val(capacite_reservoir);
    $('#vitesse_max').val(vitesse_max);
    $('#style').val(style);
    $('#type_carburant').val(type_carburant);
    $('#transmission').val(transmission);
    $('#nombre_portes').val(nombre_portes);
    $('#nombre_places').val(nombre_places);
    console.log(' fin afficherFormulaireModification  VEHICULE appellee');
    $('#modVForm').show();
    // Afficheage  formulaire de modification vehicule
    
   }
window.afficherFormulaireModificationVehicule=afficherFormulaireModificationVehicule;

//fonction qui affiche le formulaire pour modifier UN ARTICLE NEWS afficherModificationNews
function afficherModificationNews(id_news,titre,texte,paragraphes,lien,image_url,image_url_secondaire,image_url_troisieme){
     // les champs du formulaire sont préremplit avec les données de la marque existants dans la bdd
     console.log(' afficherFormulaireModification NEWS appellee');
     console.log(paragraphes);

     $('#id_news').val(id_news);
     $('#titre').val(titre);
     $('#texte').val(texte);
     $('#paragraphes').val(paragraphes);
     $('#lien').val(lien);
     $('#image_url').val(image_url);
     $('#image_url_secondaire').val(image_url_secondaire);
     $('#image_url_troisieme').val(image_url_troisieme);
     //transformer en string

      // Afficheage  formulaire de modification
      $('#upFrmNews').show();
}
window.afficherModificationNews=afficherModificationNews;

/*AJOUT NEWS */
function afficherAjoutNews(){
$('#FormAjNews').show();
}

window.afficherAjoutNews=afficherAjoutNews;
   //AJOUTER UNE MARQUE
   function afficherFormulaireAjouter(){
    console.log(' afficherFormulaireAjouter appellee');
    $('#AjouterForm').show();//affichage formulaire Ajouter Marque
   }
   window.afficherFormulaireAjouter = afficherFormulaireAjouter;
  //AJOUTER d'un vehicule
  function afficherFormulaireVAjouter(){
    console.log(' afficherFormulaireAjouter appellee');
    $('#ajoutVForm').show();//affichage formulaire Ajouter vehicule
  }
window.afficherFormulaireVAjouter=afficherFormulaireVAjouter;
/**afficher les details du vehicule LIEN ---> POP UP */
   function afficherVehiculeDetails(id, dimensions, consommation, moteur, performances, typeVehicule, tarif, image, capaciteMoteur, poids, capaciteReservoir, vitesseMax, style, typeCarburant, transmission, nombrePortes, nombrePlaces) {
    var typeVehiculeText;
    switch (typeVehicule) {
        case 1:
            typeVehiculeText = "Voiture";
            break;
        case 2:
            typeVehiculeText = "Camion";
            break;
        case 3:
            typeVehiculeText = "Moto";
            break;
        default:
            typeVehiculeText = "Autre";
            break;
    }
    var contenuPopup = `
        <div>
            <h2>Détails du véhicule</h2>
            <p>ID: ${id}</p>
            <p>Dimensions: ${dimensions}</p>
            <p>Consommation: ${consommation}</p>
            <p>moteur: ${moteur}</p>
            <p>Puissance: ${performances}</p>
            <p>typeVehicule: ${typeVehiculeText}</p>
            <p>tarif en DZ: ${tarif}</p>
            <p>lien Image: ${image}</p>
            <p>capacité Moteur: ${capaciteMoteur}</p>
            <p>Poids étant vide: ${poids}</p>
            <p>Capacité du réservoir: ${capaciteReservoir}</p>
            <p>Vitesse maximale: ${vitesseMax}</p>
            <p>Style: ${style}</p>
            <p>Type du Carburant: ${typeCarburant}</p>
            <p>Transmission: ${transmission}</p>
            <p>Nombre de portes: ${nombrePortes}</p>
            <p>Nombre de Places: ${nombrePlaces}</p>

        </div>
    `;

    // Affichage du pop-up avec le contenu
    $(contenuPopup).dialog({
        modal: true,
       
        width: '300px',
        height: 'auto',
        position: {
            my: "right ",
            at: "right ",
            of: $(document.activeElement) // Position par rapport à l'élément actif (le lien cliqué)
        },
        dialogClass: 'custom-dialog', // Ajout d'une classe CSS personnalisée pour le style
      
    });
}
window.afficherVehiculeDetails=afficherVehiculeDetails;


/**PAGE PARAMETRES */
//fonction qui affiche le formulaire de modification des contact du site
function affFormModContact(adresse,email_contact,telephone_contact,description){
// les champs du formulaire sont preremplit avec les données du contact existants dans la bdd

console.log(' afficherFormulaireModification  CONTACT appellee');
$('#adresse').val(adresse);
$('#email_contact').val(email_contact);
$('#telephone_contact').val(telephone_contact);

$('#description').val(description);



// Afficheage  formulaire de modification
$('#formModContact').show();
}
window.affFormModContact=affFormModContact;

//fct qui affiche formualire modification de modification Guide 

function affFormModGuide(id_guide,guide){
    // les champs du formulaire sont preremplit avec les données du contact existants dans la bdd
    
    console.log(' afficherFormulaireModification  guide appellee');
    $('#id_guide').val(id_guide);
    $('#guide').val(guide);
   
    

    
    // Afficheage  formulaire de modification
    $('#formModGuide').show();
    }
    window.affFormModGuide=affFormModGuide;

    //formulaire ajout  dansle guide d'achat
    function affAjFormGuide(){
        console.log(' afficherFormulaireAjouter GUIDE appellee');
        $('#formAjGuide').show();//affichage formulaire Ajouter guide
      }
    window.affAjFormGuide=affAjFormGuide;

    //affichage form ajout news diapo:
    function afficherAjoutNewsDiapo(){
        $('#FormAjNewsDiapo').show();
    }
    window.afficherAjoutNewsDiapo=afficherAjoutNewsDiapo;
    //afcihage form modification image et lien news diapo

    function afficherModificationNewsDiapo(id_news,lien,image_url){
 // les champs du formulaire sont préremplit avec les données de la marque existants dans la bdd
 console.log(' afficherFormulaireModification NEWS appellee');
 console.log(paragraphes);

 $('#id_news').val(id_news);

 $('#lien').val(lien);
 $('#image_url').val(image_url);



  // Afficheage  formulaire de modification
  $('#upFrmNewsDiapo').show();
    }
    window.afficherModificationNewsDiapo=afficherModificationNewsDiapo;  

    
     //affichage form ajout pub diapo:
     function afficherAjoutPubDiapo(){
        $('#addFrmPubDiapo').show();
    }
    window.afficherAjoutPubDiapo=afficherAjoutPubDiapo;
    
    //fonction qui affiche le formulaire de modification d'une publicité
    function afficherModificationPubDiapo(id_publicite,lien,image_url){
// les champs du formulaire sont préremplit avec les données de la pub existants dans la bdd
     console.log(' afficherFormulaireModification pub appellee');
      

         $('#id_publicite').val(id_publicite);

         $('#lien_pub').val(lien);
         $('#image_url_pub').val(image_url);
         
         $('#upFrmPubDiapo').show();
    }
    window.afficherModificationPubDiapo=afficherModificationPubDiapo;

/****************************ajouter filtre sexe user */


});
