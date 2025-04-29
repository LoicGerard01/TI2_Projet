<?php
require('./admin/src/php/utils/check_connection_client.php');
//var_dump($_SESSION['client']);
print "<h2 class='my-4'>Bienvenue, ".htmlspecialchars($_SESSION['client']['prenom_client'])." !</h2>";
$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
$title = "Accueil Client";
$salleDAO = new SalleDAO($cnx);
?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($liste as $representation): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <!-- Image -->
                <img src="./admin/assets/images/<?= htmlspecialchars($representation->getImage()); ?>" class="card-img-top" alt="<?= htmlspecialchars($representation->getTitre()); ?>">

                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($representation->getTitre()); ?></h5>
                    <p class="card-text">
                        <strong>Type :</strong> <?= htmlspecialchars($representation->getType()); ?><br>
                        <strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($representation->getDate_representation()))); ?><br>
                    </p>

                    <!-- Description Button (Popup) -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDescription_<?= $representation->getId_representation(); ?>">
                        Voir la description
                    </button>

                    <!-- Modal for Description -->
                    <div class="modal fade" id="modalDescription_<?= $representation->getId_representation(); ?>" tabindex="-1" aria-labelledby="modalDescriptionLabel_<?= $representation->getId_representation(); ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDescriptionLabel_<?= $representation->getId_representation(); ?>">Description de <?= htmlspecialchars($representation->getTitre()); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?= nl2br(htmlspecialchars($representation->getDescription())); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Button (only visible if client is logged in) -->
                    <?php if (isset($_SESSION['client']) && !empty($_SESSION['client'])): ?>
                        <button type="button" class="btn btn-success mt-3" onclick="window.location.href='reservations.php?representation_id=<?= $representation->getId_representation(); ?>'">
                            Réserver
                        </button>
                    <?php else: ?>
                        <!-- Tooltip for not logged in users -->
                        <button class="btn btn-warning mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Vous devez vous connecter pour réserver">
                            Se connecter pour réserver
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
