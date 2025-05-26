<?php
require ('src/php/utils/check_connection.php');

$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
$title = "Gestion des représentations";
$salleDAO = new SalleDAO($cnx);
$liste_s = $salleDAO->getSalles();
?>

<div class="container my-5">
    <!-- Titre de page -->
    <h1 class="text-center fw-bold text-uppercase text-primary mb-4">
        <i class="fas fa-calendar-check me-2"></i> Gestion des Représentations
    </h1>

    <!-- Bouton d'ajout -->
    <div class="d-flex justify-content-end mb-3">
        <a href="index_.php?page=nouvelle_representation.php" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle me-2"></i> Ajouter une Représentation
        </a>
    </div>

    <!-- Nouvelle ligne -->
    <div id="nouvelle_ligne"></div>

    <!-- Tableau -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle text-center rounded">
                    <thead class="bg-light text-dark fw-bold">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Salle</th>
                        <th>Places</th>
                        <th>Supp.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($liste as $representation): ?>
                        <tr>
                            <!-- ID -->
                            <td><?= $representation->getId_representation(); ?></td>

                            <!-- Titre -->
                            <td contenteditable="true" data-champ="titre" id="<?= $representation->getId_representation(); ?>">
                                <?= htmlspecialchars($representation->getTitre()); ?>
                            </td>

                            <!-- Type -->
                            <td contenteditable="true" data-champ="type" id="<?= $representation->getId_representation(); ?>">
                                <?= htmlspecialchars($representation->getType()); ?>
                            </td>

                            <!-- Date -->
                            <td data-champ="date_representation" id="<?= $representation->getId_representation(); ?>">
                                <input type="datetime-local"
                                       value="<?= date('Y-m-d\TH:i', strtotime($representation->getDate_representation())); ?>"
                                       class="form-control form-control-sm shadow-sm date-input"
                                       data-id="<?= $representation->getId_representation(); ?>">
                            </td>

                            <!-- Image -->
                            <td data-champ="image" id="<?= $representation->getId_representation(); ?>">
                                <div class="d-flex align-items-center">
                                    <img src="../admin/assets/images/<?= htmlspecialchars($representation->getImage()); ?>"
                                         alt="Image"
                                         class="rounded shadow-sm me-2"
                                         style="max-width: 140px; max-height: 140px;">
                                    <span contenteditable="true"
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
                                <?= htmlspecialchars($representation->getPrix()); ?>
                            </td>

                            <!-- Salle -->
                            <td data-champ="salle" id="<?= $representation->getId_representation(); ?>">
                                <i class="fa-solid fa-door-closed me-2"></i>
                                <select class="form-select form-select-sm shadow-sm w-auto salle-select"
                                        data-id="<?= $representation->getId_representation(); ?>"
                                        title="Changer de salle">
                                    <?php foreach ($liste_s as $salle): ?>
                                        <option value="<?= $salle->id_salle; ?>"
                                            <?= ($salle->id_salle == $representation->getSalle()) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($salle->num_salle); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <!-- Nb sièges -->
                            <td><?= $representation->getNb_sieges(); ?></td>

                            <!-- Suppression -->
                            <td class="text-danger delete" data-id="<?= $representation->getId_representation(); ?>"
                                style="cursor: pointer;" title="Supprimer">
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
