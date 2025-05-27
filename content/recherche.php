<?php
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
if (!empty($query)) {
    $representationDAO = new Vue_representationsDAO($cnx);
    $resultats = $representationDAO->searchByTitle($query);
 //   echo "<pre>";
   // var_dump($resultats);
    //echo "</pre>";
} else {

    $resultats = [];
}
?>

<div class="container mt-4">
    <h2>Résultats de la recherche : <?= htmlspecialchars($_GET['query']) ?></h2>

    <?php if (empty($resultats)) : ?>
        <p class="alert alert-warning">Aucune représentation trouvée.</p>
    <?php else : ?>
        <div class="row">
            <?php foreach ($resultats as $representation) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($representation->getTitre()) ?></h5>
                            <p class="card-text"><strong>Date :</strong> <?= htmlspecialchars($representation->getDate_representation()) ?></p>
                            <p class="card-text"><?= nl2br(htmlspecialchars($representation->getDescription())) ?></p>
                            <a href="index_.php?page=fiche_representation.php&id=<?= $representation->getId_representation() ?>" class="btn btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

