<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

if (isset($_GET['titre'])) {
    $titre = $_GET['titre'];
    $representationDAO = new RepresentationDAO($cnx);
    $rep = $representationDAO->getRepresentationByTitre($titre);

    if ($rep) {
        echo json_encode([$rep]);
    } else {
        echo json_encode([]);
    }
}
