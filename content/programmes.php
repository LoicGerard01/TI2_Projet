<?php
//var_dump($_SESSION['client']);
$representations = new Vue_representationsDAO($cnx);
$liste = $representations->getAllRepresentations();
$title = "Nos programmes";
$salleDAO = new SalleDAO($cnx);
?>

<h3> - Tous nos programmes -</h3>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($liste as $representation): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <!-- Image -->
                <img src="./admin/assets/images/<?= htmlspecialchars($representation->getImage()); ?>"
                     class="card-img-top" alt="<?= htmlspecialchars($representation->getTitre()); ?>">

                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($representation->getTitre()); ?></h5>
                    <p class="card-text">
                        <strong>Type :</strong> <?= htmlspecialchars($representation->getType()); ?><br>
                        <strong>Date
                            :</strong> <?= htmlspecialchars(date('d/m/Y H:i', strtotime($representation->getDate_representation()))); ?>
                        <br>
                        <strong>Prix :</strong> <?= htmlspecialchars($representation->getPrix()); ?>
                    </p>

                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#modalDescription_<?= $representation->getId_representation(); ?>">
                        Voir la description
                    </button>

                    <div class="modal fade" id="modalDescription_<?= $representation->getId_representation(); ?>"
                         tabindex="-1"
                         aria-labelledby="modalDescriptionLabel_<?= $representation->getId_representation(); ?>"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="modalDescriptionLabel_<?= $representation->getId_representation(); ?>">
                                        Description de <?= htmlspecialchars($representation->getTitre()); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?= nl2br(htmlspecialchars($representation->getDescription())); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['client']) && !empty($_SESSION['client'])): ?>
                        <a href="index_.php?page=reservation_confirmation.php&id_representation=<?= $representation->getId_representation(); ?>&id_salle=<?= $representation->getSalle(); ?>" class="btn btn-success mt-3">
                            Réserver
                        </a>

                        <div class="result-reservation mt-2"
                             id="result-<?= $representation->getId_representation(); ?>"></div>

                    <?php else: ?>
                        <a href="index_.php?page=login.php" class="btn btn-warning mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Vous devez vous connecter pour réserver">
                            Se connecter pour réserver
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
