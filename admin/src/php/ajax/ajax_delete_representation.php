<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Representation.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$representationDAO = new RepresentationDAO($cnx);

$id = $_GET['id_representation'] ?? null;
if ($id) {
    $representationDAO->delete_representation($id);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'ID manquant']);
}
