$(document).ready(function(){

    // SOUMISSION DU FORMULAIRE (AJOUT / MÀJ)
    $('#form_representation').on('submit', function (e) {
        e.preventDefault();

        let id = $('#id_representation').val();
        let titre = $('#nom_representation').val();
        let type = $('#type_representation').val();
        let date = $('#date_representation').val();
        let image = $('#image_representation').val();
        let salle = $('#salle_representation').val();

        let param = {
            id_representation: id,
            titre: titre,
            type: type,
            date: date,
            image: image,
            salle: salle
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: param,
            url: 'src/php/ajax/ajax_add_representation.php',
            success: function (data) {
                console.log("Retour ajout / update", data);
                if (data.success) {
                    $('#zone_rapport').html("<p style='color:green;'>Opération réussie !</p>").show();
                } else {
                    $('#zone_rapport').html("<p style='color:red;'>Erreur : " + data.message + "</p>").show();
                }
            }
        });
    });

    // Édition en ligne
    $(document).ready(function () {
        $('td[contenteditable="true"]').on('blur', function () {
            let champ = $(this).data('champ');
            let valeur = $(this).text().trim();
            let id_representation = $(this).attr('id');

            console.log("Champ:", champ, "Valeur:", valeur, "ID:", id_representation);

            $.ajax({
                url: 'src/php/ajax/ajax_update_representation.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    champ: champ,
                    valeur: valeur,
                    id_representation: id_representation
                }
            });
        });
    });

    // pour récuperer la salle lors de la modification
    $(document).on('change', '.salle-select', function () {
        const id = $(this).data('id');
        const valeur = $(this).val();
        const champ = 'salle';

        console.log("Champ:", champ, "Valeur:", valeur, "ID:", id); // Pour debugger

        $.ajax({
            url: 'src/php/ajax/ajax_update_representation.php',
            method: 'GET',
            dataType: 'json',
            data: {
                champ: champ,
                valeur: valeur,
                id_representation: id
            }
        });
    });

    // pour récuperer la date lors de la modification

    $('td[contenteditable="true"]').on('blur', function () {
        let champ = $(this).data('champ');
        let id_representation = $(this).attr('id');
        let valeur;

        // Si l'élément est un input de type date, on récupère la valeur de l'input
        if ($(this).find('input[type="date"]').length) {
            valeur = $(this).find('input[type="date"]').val().trim();
        } else {
            valeur = $(this).text().trim();
        }

        console.log("Champ:", champ, "Valeur:", valeur, "ID:", id_representation);

        $.ajax({
            url: 'src/php/ajax/ajax_update_representation.php',
            method: 'GET',
            dataType: 'json',
            data: {
                champ: champ,
                valeur: valeur,
                id_representation: id_representation
            }
        });
    });






    // Suppression
    $('.edit_no_js').hide();
    $('.delete').css('cursor','pointer');

    $('.delete').click(function(){
        let id_representation = $(this).data("id");
        let ligne = $(this).closest('tr');
        ligne.css('background-color','lightpink');
        ligne.fadeOut(1000);

        $.ajax({
            type: 'get',
            dataType: 'json',
            data: { id_representation },
            url: "src/php/ajax/ajax_delete_representation.php",
            success: function (data){
                console.log(data);
            }
        });
    });

    // Vérification du nom de représentation
    $('#zone_rapport, #zone_id_representation').hide();
    $('#submit_representation').val("Ajouter");

    $('#nom_representation').on('blur', function(){
        let nom_representation = $(this).val();
        let param = 'nom_representation=' + encodeURIComponent(nom_representation);

        $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: "src/php/ajax/ajax_search_representation.php",
            success: function(data){
                if(data && data.length > 0){
                    let rep = data[0];
                    $('#id_representation').val(rep.id_representation);
                    $('#type_representation').val(rep.type);
                    $('#date_representation').val(rep.date_representation);
                    $('#image_representation').val(rep.image);
                    $('#salle_representation').val(rep.salle);
                    $('#zone_id_representation').show();
                    $('#submit_representation').val("Mettre à jour");
                } else {
                    $('#id_representation').val('');
                    $('#submit_representation').val("Ajouter");
                }
            }
        });
    });

});
