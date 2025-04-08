$(document).ready(function() {
    $('#zone_rapport').hide();
    $('#titre').blur(function () {
        let titre = $(this).val();
        console.log("Titre saisi :", titre);

        $.ajax({
            type: "GET",
            url: "src/php/ajax/ajax_search_representation.php",
            data: {titre: titre},
            dataType: "json",
            success: function (data) {
                if (data && data.length > 0) {
                    console.log("Représentation existante trouvée :", data);
                    $('#type').val(data[0].type);
                    $('#date_representation').val(data[0].date_representation);
                    $('#salle').val(data[0].salle);
                    $('#submit_mission').val("Mettre à jour la représentation");
                    $('#zone_rapport').show();
                } else {
                    console.log("Aucune représentation trouvée.");
                    $('#submit_mission').val("Ajouter la représentation");
                }
            },
            error: function (xhr, status, error) {
                console.error("Erreur AJAX :", status, error);
            }
        });
    });
});
