<!-- gestion_representation.php -->
<?php
$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
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
        <th>Numéro de salle</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($liste as $representation): ?>
        <tr>
            <th scope="row" id="<?= $representation->getId_representation(); ?>"><?= $representation->getId_representation(); ?></th>
            <td contenteditable="true" data-champ="titre_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getTitre(); ?></td>
            <td contenteditable="true" data-champ="type_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getType(); ?></td>
            <td contenteditable="true" data-champ="date_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getDate_representation(); ?></td>
            <td contenteditable="true" data-champ="image_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getImage(); ?></td>
            <td contenteditable="true" data-champ="salle_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getSalle(); ?></td>
            <td contenteditable="true" data-champ="nb_sieges_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getNb_sieges(); ?></td>
            <td contenteditable="true" data-champ="num_salle_representation" id="<?= $representation->getId_representation(); ?>"><?= $representation->getNum_salle(); ?></td>
            <td class="edit_no_js"><i class="fa-solid fa-pencil"></i></td>
            <td class="delete" data-id="<?= $representation->getId_representation(); ?>"><i class="fa-solid fa-trash"></i></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
