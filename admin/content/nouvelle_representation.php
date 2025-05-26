<?php
require ('src/php/utils/check_connection.php');
$title = "Nouvelle représentation";

$salleDAO = new SalleDAO($cnx);
$liste_s = $salleDAO->getSalles();
?>

<form id="form_representation" class="mx-auto" style="max-width:600px;">
    <input type="hidden" id="id_representation" name="id_representation" />

    <div class="container my-5">
        <div class="card p-5 shadow-sm">
            <h2 class="card-title text-center mb-5">Nouvelle Représentation</h2>

            <div class="mb-4">
                <label for="nom_representation" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="nom_representation" name="titre" placeholder="Titre de la représentation" required />
                <div id="results" class="mt-2"></div>
            </div>

            <div class="mb-4">
                <label for="type_representation" class="form-label">Type :</label>
                <input type="text" class="form-control" id="type_representation" name="type" placeholder="Ex: Théâtre, Concert..." />
            </div>

            <div class="mb-4">
                <label for="date_representation" class="form-label">Date :</label>
                <input type="date" class="form-control" id="date_representation" name="date" />
            </div>

            <div class="mb-4">
                <label for="image_representation" class="form-label">Image (URL) :</label>
                <input type="text" class="form-control" id="image_representation" name="image" placeholder="https://exemple.com/image.jpg" />
            </div>

            <div class="mb-4">
                <label for="description_representation" class="form-label">Description :</label>
                <textarea class="form-control" id="description_representation" name="description" rows="4" placeholder="Description détaillée..."></textarea>
            </div>

            <div class="mb-4">
                <label for="prix_representation" class="form-label">Prix :</label>
                <input type="text" class="form-control" id="prix_representation" name="prix"
                       pattern="[0-9]+(\.[0-9]{1,2})?" title="Format: 00.00" placeholder="Ex: 20.00" required />
            </div>

            <div class="mb-4">
                <label for="salle_representation" class="form-label">Salle :</label>
                <select id="salle_representation" name="salle" class="form-select">
                    <?php foreach ($liste_s as $s): ?>
                        <option value="<?= htmlspecialchars($s->id_salle); ?>">
                            <?= htmlspecialchars($s->num_salle); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" id="submit_representation" class="btn btn-primary" value="Ajouter ou mettre à jour" />
            </div>
        </div>
    </div>
</form>

<div id="zone_id_representation" style="display:none">
    <p>ID existant : <span id="zone_id_value"></span></p>
</div>

<div id="zone_rapport" style="display:none"></div>
