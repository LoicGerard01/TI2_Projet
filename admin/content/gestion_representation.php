<!-- gestion_representation.php -->
<?php
$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
$title = "Gestion des représentations";
$salleDAO = new SalleDAO($cnx);
$liste_s = $salleDAO->getSalles();
?>

<p class="txtGras txtItalic red" id="ajouter_representation">
    <a id="ajouter_representation_no_js" href="./index_.php?page=nouvelle_representation.php">Nouvelle Représentation</a>
</p>

<div id="nouvelle_ligne"></div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Titre</th>
        <th>Type</th>
        <th>Date</th>
        <th>Image</th>
        <th>Salle</th>
        <th>Nombre de sièges</th>
        <th>SUPPRESSION</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($liste as $representation): ?>
        <tr>
            <th scope="row" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getId_representation(); ?>
            </th>

            <td contenteditable="true" data-champ="titre" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getTitre(); ?>
            </td>

            <td contenteditable="true" data-champ="type" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getType(); ?>
            </td>

            <td contenteditable="true" data-champ="date_representation" id="<?= $representation->getId_representation(); ?>">
                <input type="date" value="<?= $representation->getDate_representation(); ?>" class="form-control date-input" id="date_<?= $representation->getId_representation(); ?>">
            </td>


            <td contenteditable="true" data-champ="image" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getImage(); ?>
            </td>

            <td data-champ="salle" id="<?= $representation->getId_representation(); ?>">
                <select class="form-select salle-select" data-id="<?= $representation->getId_representation(); ?>">
                    <?php foreach ($liste_s as $salle): ?>
                        <option value="<?= $salle->id_salle; ?>"
                            <?= ($salle->id_salle == $representation->getSalle()) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($salle->num_salle); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <td contenteditable="false" data-champ="nb_sieges" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getNb_sieges(); ?>
            </td>

            <td hidden="hidden" contenteditable="false" data-champ="num_salle" id="<?= $representation->getId_representation(); ?>">
                <?= $representation->getNum_salle(); ?>
            </td>

            <td class="edit_no_js"><i class="fa-solid fa-pencil"></i></td>
            <td class="delete" data-id="<?= $representation->getId_representation(); ?>">
                <i class="fa-solid fa-trash"></i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
