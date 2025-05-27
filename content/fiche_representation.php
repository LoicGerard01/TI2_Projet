<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$representationDAO = new Vue_representationsDAO($cnx);
$rep = $representationDAO->getRepresentationById($id);

if (!$rep) {
    echo "<div class='container my-4'><p class='text-danger'>Représentation non trouvée.</p></div>";
    return;
}

$salleDAO = new SalleDAO($cnx);
?>
<div class="fiche_representation">
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <img src="admin/assets/images/<?= htmlspecialchars($rep->getImage()); ?>" alt="Image de <?= htmlspecialchars($rep->getTitre()); ?>" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8">
            <h2><?= htmlspecialchars($rep->getTitre()); ?></h2>
            <p class="text-muted"><?= htmlspecialchars($rep->getType()); ?> | <?= htmlspecialchars($rep->getDate_representation()); ?></p>
            <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($rep->getDescription())); ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($rep->getPrix()); ?> </p>

            <a href="index_.php?page=programmes.php" class="btn btn-secondary mt-3">← Retour aux programmes</a>
            <?php if (isset($_SESSION['client']) && !empty($_SESSION['client'])): ?>
                <a href="index_.php?page=reservation_confirmation.php&id_representation=<?= $rep->getId_representation(); ?>&id_salle=<?= $rep->getSalle(); ?>" class="btn btn-success mt-3">
                    Réserver
                </a>

                <div class="result-reservation mt-2"
                     id="result-<?= $rep->getId_representation(); ?>"></div>

            <?php else: ?>
                <a href="index_.php?page=login.php" class="btn btn-warning mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Vous devez vous connecter pour réserver">
                    Se connecter pour réserver
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>