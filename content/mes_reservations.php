<?php
require('./admin/src/php/utils/check_connection_client.php');

$reservationDAO = new Vue_reservationsDAO($cnx);
$id_client = $_SESSION['client']['id_client'];
$reservations = $reservationDAO->getReservationsByClient($id_client);
?>

<div class="container my-5">
    <h2 class="mb-4">Mes Réservations à venir</h2>

    <?php if (count($reservations) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Salle</th>
                    <th>Numéro de réservation</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?= htmlspecialchars($res->getTitre()); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($res->getDate_representation())); ?></td>
                        <td><?= htmlspecialchars($res->getNum_salle()); ?></td>
                        <td><?= htmlspecialchars($res->getId_reservation()); ?></td>
                        <td>
                            <a href="./content/generate_ticket.php?id_reservation=<?= urlencode($res->getId_reservation()); ?>"
                               class="btn btn-primary btn-sm" target="_blank">
                                Télécharger le ticket PDF
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">Vous n'avez aucune réservation à venir.</p>
    <?php endif; ?>
</div>