$(document).ready(function () {

    // SOUMISSION DU FORMULAIRE (AJOUT / MÀJ)
    $('#form_representation').on('submit', function (e) {
        e.preventDefault();

        let id = $('#id_representation').val();
        let titre = $('#nom_representation').val();
        let type = $('#type_representation').val();
        let date = $('#date_representation').val();
        let image = $('#image_representation').val();
        let description = $('#description_representation').val();
        let prix = $('#prix_representation').val();
        let salle = $('#salle_representation').val();

        // Convertir la date en timestamp avec heure et fuseau horaire
        let timestamp = new Date(date).toISOString(); // Utilisation de toISOString pour avoir la date avec le fuseau horaire

        let param = {
            id_representation: id,
            titre: titre,
            type: type,
            date: timestamp,
            image: image,
            description: description,
            prix: prix,
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

    // Fonction générique pour faire un appel AJAX
    function updateRepresentation(champ, valeur, id_representation) {
        if (champ && valeur && id_representation) {
            $.ajax({
                url: 'src/php/ajax/ajax_update_representation.php',
                method: 'GET',
                data: {
                    champ: champ,
                    valeur: valeur,
                    id_representation: id_representation
                },
                success: function (response) {
                    console.log("Réponse brute serveur:", response);

                    // Essayons de parser nous-même
                    try {
                        let data = (typeof response === "object") ? response : JSON.parse(response);
                        console.log("Mise à jour réussie:", data);
                    } catch (e) {
                        console.error("Erreur de parsing JSON:", e, response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur AJAX:", error, xhr.responseText);
                }
            });
        }
    }

    // Modification INLINE des champs contenteditable
    $('td[contenteditable="true"]').on('blur', function () {
        let champ = $(this).data('champ');
        let valeur = $(this).text().trim();
        let id_representation = $(this).attr('id');

        console.log("Update field:", champ, "New value:", valeur, "For ID:", id_representation);

        updateRepresentation(champ, valeur, id_representation);
    });

    // Modification de la DATE
    $('.date-input').on('change', function () {
        let valeur = $(this).val();
        let id_representation = $(this).data('id');
        let champ = 'date_representation'; // Champ fixe pour date

        console.log("Update DATE:", champ, "New value:", valeur, "For ID:", id_representation);

        // Conversion propre au format YYYY-MM-DD
        if (valeur && valeur.includes('T')) {
            valeur = valeur.split('T')[0];
        }

        updateRepresentation(champ, valeur, id_representation);
    });

    // Modification de la salle
    $(document).on('change', '.salle-select', function () {
        const id = $(this).data('id');
        const valeur = $(this).val();
        const champ = 'salle';

        console.log("Update salle:", champ, "New value:", valeur, "For ID:", id);

        updateRepresentation(champ, valeur, id);
    });

    // Modification du nom de l'image
    $('td[data-champ="image"] span[contenteditable="true"]').on('blur', function () {
        let champ = 'image';
        let valeur = $(this).text().trim();
        let id_representation = $(this).attr('id');

        console.log("Update image:", champ, "New value:", valeur, "For ID:", id_representation);

        updateRepresentation(champ, valeur, id_representation);
    });

    // Suppression d'une ligne
    $('.delete').click(function () {
        let id_representation = $(this).data("id");
        let ligne = $(this).closest('tr');
        ligne.css('background-color', 'lightpink');
        ligne.fadeOut(1000);

        $.ajax({
            type: 'get',
            url: "src/php/ajax/ajax_delete_representation.php",
            data: {id_representation},
            success: function (response) {
                console.log("Réponse suppression:", response);
            },
            error: function (xhr, status, error) {
                console.error("Erreur AJAX suppression:", error, xhr.responseText);
            }
        });
    });

    // Vérification du nom de représentation
    $('#zone_rapport, #zone_id_representation').hide();
    $('#submit_representation').val("Ajouter");

    $('#nom_representation').on('blur', function () {
        let nom_representation = $(this).val();
        let param = 'nom_representation=' + encodeURIComponent(nom_representation);

        $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: "src/php/ajax/ajax_search_representation.php",
            success: function (data) {
                if (data && data.length > 0) {
                    let rep = data[0];
                    $('#id_representation').val(rep.id_representation);
                    $('#type_representation').val(rep.type);
                    $('#date_representation').val(rep.date_representation);
                    $('#image_representation').val(rep.image);
                    $('#description_representation').val(rep.description);
                    $('#prix_representation').val(rep.prix);
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

    // script pour la réservation d'une représentation

    const bouton = document.getElementById("btn-payer");
    const message = document.getElementById("message-paiement");

    if (bouton) {
        bouton.addEventListener("click", function () {

            bouton.disabled = true;
            bouton.innerText = "Paiement en cours...";

            const id_representation = bouton.getAttribute('data-id-representation');
            const id_salle = bouton.getAttribute('data-id-salle');

            if (!id_representation || !id_salle) {
                message.innerHTML = '<div class="alert alert-danger">Erreur : données de réservation manquantes.</div>';
                return;
            }

            fetch('admin/src/php/ajax/ajax_add_reservation.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `id_representation=${encodeURIComponent(id_representation)}&id_salle=${encodeURIComponent(id_salle)}`
            })
                .then(response => response.text())
                .then(text => {
                    console.log("Réponse brute serveur :", text);

                    try {
                        const data = JSON.parse(text);
                        console.log("Réponse JSON parsée :", data);
                    } catch (e) {
                        console.error(" Erreur de parsing JSON :", e);
                    }
                })
                .catch(error => {
                    console.error('Erreur FETCH :', error);
                });
            // Simuler un délai pour le paiement
            setTimeout(() => {
                bouton.disabled = false;
                bouton.innerText = "Payer";
                message.innerHTML = '<div class="alert alert-success">Paiement réussi !</div>';
            }, 2000);

        });
    }







});
