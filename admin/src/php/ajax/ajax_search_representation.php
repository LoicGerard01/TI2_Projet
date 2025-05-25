<?php
header('Content-Type: application/json');

require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Representation.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$representationDAO = new RepresentationDAO($cnx);

$titre = trim($_GET['nom_representation'] ?? '');

if (empty($titre)) {
    echo json_encode(['error' => 'Titre manquant']);
    exit;
}

$data = $representationDAO->ajax_get_representation($titre);

if (is_array($data)) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Erreur interne']);
}
exit;
