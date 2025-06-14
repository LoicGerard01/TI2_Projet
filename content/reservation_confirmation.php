<?php
require('./admin/src/php/utils/check_connection_client.php');

// Récupération des paramètres
$id_representation = $_GET['id_representation'] ?? null;
$id_salle = $_GET['id_salle'] ?? null;

if (!$id_representation || !$id_salle) {
    echo "Paramètres manquants.";
    exit;
}

// Récupération des détails de la représentation (visuel)
$cnx = Connection::getInstance($dsn, $user, $password);
$dao = new Vue_representationsDAO($cnx);
$daoClient = new ClientDAO($cnx);
$client = $daoClient->getClientById($_SESSION['client']['id_client']);

$representation = $dao->getRepresentationById($id_representation);

if (!$representation) {
    echo "Représentation introuvable.";
    exit;
}
?>

<h1 class="ConfirmationReservation">Confirmation de réservation</h1>
<h2 class="mb-4">Informations Personnelles</h2>
<div class="card">
    <div class="card-body">
        <p class="card-text">
            Nom : <?= htmlspecialchars($client['nom_client']) ?><br>
            Prenom : <?= htmlspecialchars($client['prenom_client']) ?><br>
            Mail : <?= htmlspecialchars($client['email']) ?><br>
            Mobile : <?= htmlspecialchars($client['mobile']) ?><br>
    </div>
</div>
<br>
<h2 class="mb-4">Votre représentation choisie :</h2>
<div class="card">
    <div class="card-body">
        <h2 class="card-title">Titre : <?= htmlspecialchars($representation->getTitre()) ?></h2>
        <p class="card-text">
            Type : <?= htmlspecialchars($representation->getType()) ?><br>
            <strong>Date
                :</strong> <?= htmlspecialchars(date('d/m/Y H:i', strtotime($representation->getDate_representation()))); ?>
            <br>
            Salle n°: <?= htmlspecialchars($representation->getSalle()) ?><br>
            Prix : <?= htmlspecialchars($representation->getPrix()) ?>
        </p>
        <button id="btn-payer"
                class="btn btn-primary"
                data-id-representation="<?= htmlspecialchars($id_representation) ?>"
                data-id-salle="<?= htmlspecialchars($id_salle) ?>">
            Payer maintenant (fictif)
        </button>
    </div>
</div>

<div class="mt-3" id="message-paiement"></div>
