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

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <img src="admin/assets/images/<?= htmlspecialchars($rep->getImage()); ?>" alt="Image de <?= htmlspecialchars($rep->getTitre()); ?>" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8">
            <h2><?= htmlspecialchars($rep->getTitre()); ?></h2>
            <p class="text-muted"><?= htmlspecialchars($rep->getType()); ?> | <?= htmlspecialchars($rep->getDate_representation()); ?></p>
            <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($rep->getDescription())); ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($rep->getPrix()); ?> €</p>

            <a href="index_.php?page=programmes.php" class="btn btn-secondary mt-3">← Retour aux programmes</a>
        </div>
    </div>
</div>
