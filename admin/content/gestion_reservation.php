<?php
require('src/php/utils/check_connection.php');

$reservationDAO = new ReservationDAO($cnx);
$reservations = $reservationDAO->getAllReservations();

$title = "Gestion des réservations";
?>

<div class="container my-5">
    <h1 class="text-center fw-bold text-uppercase text-primary mb-4">
        <i class="fas fa-ticket-alt me-2"></i> Gestion des Réservations
    </h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-light fw-bold">
                <tr>
                    <th>ID</th>
                    <th>ID Client</th>
                    <th>ID Représentation</th>
                    <th>ID Salle</th>
                    <th>Date de réservation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?= $res->getId_reservation(); ?></td>
                        <td><?= $res->getId_client(); ?></td>
                        <td><?= $res->getId_representation(); ?></td>
                        <td><?= $res->getId_salle(); ?></td>
                        <td><?= $res->getDate_reservation(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
