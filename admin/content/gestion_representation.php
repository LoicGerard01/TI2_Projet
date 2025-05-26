<?php
$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
$title = "Gestion des représentations";
$salleDAO = new SalleDAO($cnx);
$liste_s = $salleDAO->getSalles();
?>

<!-- Gestion des représentations -->
<div class="container my-4">
    <p class="fw-bold fst-italic text-danger" id="ajouter_representation">
        <a id="ajouter_representation_no_js" href="./index_.php?page=nouvelle_representation.php"
           class="btn btn-primary">
            Nouvelle Représentation
        </a>
    </p>

    <div id="nouvelle_ligne"></div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Type</th>
                <th>Date</th>
                <th>Image</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Salle</th>
                <th>Nombre de sièges</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($liste as $representation): ?>
                <tr>
                    <!-- Id -->
                    <td><?= $representation->getId_representation(); ?></td>

                    <!-- Titre -->
                    <td contenteditable="true" data-champ="titre" id="<?= $representation->getId_representation(); ?>">
                        <?= htmlspecialchars($representation->getTitre()); ?>
                    </td>

                    <!-- Type -->
                    <td contenteditable="true" data-champ="type" id="<?= $representation->getId_representation(); ?>">
                        <?php
                        $type = htmlspecialchars($representation->getType());
                        ?>
                        <span class=""><?= $type; ?></span>
                    </td>

                    <!-- Date -->
                    <td data-champ="date_representation" id="<?= $representation->getId_representation(); ?>">
                        <input type="datetime-local"
                               value="<?= date('Y-m-d\TH:i', strtotime($representation->getDate_representation())); ?>"
                               class="form-control form-control-sm d-inline w-auto date-input"
                               data-id="<?= $representation->getId_representation(); ?>">
                    </td>


                    <!-- Image -->
                    <td id="<?= $representation->getId_representation(); ?>" data-champ="image">
                        <div class="d-flex align-items-center">
                            <img src="../admin/assets/images/<?= htmlspecialchars($representation->getImage()); ?>"
                                 alt="Image"
                                 class="img-fluid me-2"
                                 style="max-width: 160px; max-height: 160px;">

                            <span contenteditable="true"
                                  data-champ="image"
                                  id="<?= $representation->getId_representation(); ?>"
                                  style="min-width: 100px; display: inline-block;">
                                  <?= htmlspecialchars($representation->getImage()); ?>
                            </span>
                        </div>
                    </td>


                    <!-- Description -->
                    <td class="description-cell" contenteditable="true" data-champ="description"
                        id="<?= $representation->getId_representation(); ?>"
                        title="<?= htmlspecialchars($representation->getDescription()); ?>">
                        <?= nl2br(htmlspecialchars($representation->getDescription())); ?>
                    </td>

                    <!-- Prix -->
                    <td contenteditable="true" data-champ="prix" id="<?= $representation->getId_representation(); ?>">
                        <?php
                        $prix = htmlspecialchars($representation->getPrix());
                        ?>
                        <span class=""><?= $prix; ?></span>
                    </td>

                    <!-- Salle -->
                    <td data-champ="salle" id="<?= $representation->getId_representation(); ?>">
                        <i class="fa-solid fa-door-closed me-2"></i>
                        <select class="form-select form-select-sm salle-select d-inline w-auto"
                                data-id="<?= $representation->getId_representation(); ?>">
                            <?php foreach ($liste_s as $salle): ?>
                                <option value="<?= $salle->id_salle; ?>" <?= ($salle->id_salle == $representation->getSalle()) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($salle->num_salle); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>

                    <!-- Nombre de sièges -->
                    <td>
                        <?= $representation->getNb_sieges(); ?>
                    </td>

                    <!-- Suppression -->
                    <td class="text-danger delete" data-id="<?= $representation->getId_representation(); ?>"
                        style="cursor: pointer;">
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
