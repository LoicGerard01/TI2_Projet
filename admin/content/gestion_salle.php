<?php
require('src/php/utils/check_connection.php');

$salleDAO = new SalleDAO($cnx);
$salles = $salleDAO->getSalles();

$title = "Gestion des salles";
?>

<div class="container my-5">
    <h1 class="text-center fw-bold text-uppercase text-primary mb-4">
        <i class="fas fa-door-closed me-2"></i> Gestion des Salles
    </h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-light fw-bold">
                <tr>
                    <th>ID</th>
                    <th>Numéro de salle</th>
                    <th>Capacité</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($salles): ?>
                    <?php foreach ($salles as $salle): ?>
                        <tr>
                            <td><?= $salle->getId_salle(); ?></td>
                            <td><?= htmlspecialchars($salle->getNum_salle()); ?></td>
                            <td><?= htmlspecialchars($salle->getCapacite()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">Aucune salle trouvée.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
