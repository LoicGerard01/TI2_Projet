<?php
$dao = new RepresentationDAO($cnx);
$representations = $dao->getAllRepresentations();
$title = "Représentations disponibles";
?>

<div class="container mt-4">
    <h2>Représentations</h2>
    <div class="row">
        <?php foreach ($representations as $rep): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="admin/assets/images/<?= htmlspecialchars($rep->image); ?>" class="card-img-top" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($rep->titre); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($rep->description); ?></p>
                        <p><strong>Date :</strong> <?= date("d/m/Y H:i", strtotime($rep->date_representation)); ?></p>
                        <p><strong>Prix :</strong> <?= htmlspecialchars($rep->prix); ?> €</p>
                        <a href="reservation.php?id=<?= $rep->id_representation; ?>" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
