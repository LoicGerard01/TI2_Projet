<?php
// nouvelle_representation.php
$title = "Nouvelle représentation";

$salleDAO = new SalleDAO($cnx);
$liste_s = $salleDAO->getSalles();

?>

<form id="form_representation">
    <input type="hidden" id="id_representation" name="id_representation" />

    <div class="container form_nouvelle_representation">
        <h2>Nouvelle représentation</h2>

        <label for="nom_representation">Titre :</label>
        <input type="text" class="form-control" id="nom_representation" name="titre" required />
        <br>

        <label for="type_representation">Type :</label>
        <input type="text" class="form-control" id="type_representation" name="type" />
        <br>

        <label for="date_representation">Date :</label>
        <input type="date" class="form-control" id="date_representation" name="date" />
        <br>

        <label for="image_representation">Image :</label>
        <input type="text" class="form-control" id="image_representation" name="image" />
        <br>

        <label for="salle_representation">Salle :</label>
        <select id="salle_representation" name="salle">
            <?php foreach ($liste_s as $s): ?>
                <option value="<?= htmlspecialchars($s->id_salle); ?>">
                    <?= htmlspecialchars($s->num_salle); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <input type="submit" id="submit_representation" class="btn btn-primary" value="Ajouter ou mettre à jour" />
    </div>
</form>

<div id="zone_id_representation" style="display:none">
    <p>ID existant : <span id="zone_id_value"></span></p>
</div>

<div id="zone_rapport" style="display:none"></div>
