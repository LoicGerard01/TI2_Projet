<?php
$representationsDAO = new Vue_representationsDAO($cnx);
$representations = $representationsDAO->getAllRepresentations();

?>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
    <tr>
     <th> scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Type</th>
        <th scope="col">Date</th>
        <th scope="col">Image</th>
        <th scope="col">Salle</th>
        <th scope="col">Nombre de sièges</th>
        <th scope="col">Numéro de salle</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($representations as $representation): ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($representation->getId_representation()); ?></th>
            <td><?= htmlspecialchars($representation->getTitre()); ?></td>
            <td><?= htmlspecialchars($representation->getType()); ?></td>
            <td><?= htmlspecialchars($representation->getDate_representation()); ?></td>
            <td>
                <?php if ($representation->getImage()): ?>
                    <img src="<?= htmlspecialchars($representation->getImage()); ?>" alt="Image" width="50">
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($representation->getSalle()); ?></td>
            <td><?= htmlspecialchars($representation->getNb_sieges()); ?></td>
            <td><?= htmlspecialchars($representation->getNum_salle()); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
