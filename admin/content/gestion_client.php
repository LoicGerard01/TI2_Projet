<?php
require('src/php/utils/check_connection.php');

$clientDAO = new ClientDAO($cnx);
$clients = $clientDAO->getAllClients();

$title = "Gestion des clients";
?>

<div class="container my-5">
    <h1 class="text-center fw-bold text-uppercase text-primary mb-4">
        <i class="fas fa-users me-2"></i> Gestion des Clients
    </h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-light fw-bold">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Mobile</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client->getId_client(); ?></td>
                        <td><?= htmlspecialchars($client->getClient_nom()); ?></td>
                        <td><?= htmlspecialchars($client->getClient_prenom()); ?></td>
                        <td><?= htmlspecialchars($client->getClient_email()); ?></td>
                        <td><?= htmlspecialchars($client->getClient_mobile()); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
