<?php
$client = $_SESSION['client'];
$title = "Profil Client";
$clientDAO = new ClientDAO($cnx);
//var_dump($client);

?>

<div class="container mt-4">
    <h2>Mes informations</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($client['nom_client']); ?></li>
        <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($client['prenom_client']); ?></li>
        <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($client['email']); ?></li>
        <li class="list-group-item"><strong>Mobile :</strong> <?= htmlspecialchars($client['mobile']); ?></li>
    </ul>
</div>
