
/******************cette fonction permet la pagination des avis en 5******************** */
function paginerAvis(vehiculeIdAvis) {
    var offset = 5; // intialiser offset a  5 
    console.log('Fonction  getVersion appelée');
    
    
    console.log("loadMoreButton");
     //requete ajax envoit le vehicule que je veux paginer ses avis, recuperer les nouveaux 5 elements de la liste des avis
        $.ajax({
            url: "/Tidjelabine/Controller/Clique_Marques.php",
            type: "GET",
            data: { 
                offset: offset ,
                vehiculeIdAvis: vehiculeIdAvis
            },
            success: function(response) {
                console.log(response);
                $("#tousAvis ul").append(response);//remplir les elements de la liste par les nouveaux  avis
                 // Afficher les 5 avis suivants et masquer les 5 precedents
            $("#tousAvis ul li:lt(" + offset + ")").hide();//cacher lesanciens 5 
            $("#tousAvis ul li:gt(" + (offset - 1) + ")").show();//afficher les nouveaux 5 avis
                offset += 5; // pour les prochaines cliques incrementer de 5 le offfset.
            },
            error: function(xhr, status, error) {
                console.error("Error loading more avis: " + error);
            }
        });
}