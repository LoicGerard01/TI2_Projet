<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/ReservationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$daoReservation = new ReservationDAO($cnx);

// Récupération des données POST
$id_representation = $_POST['id_representation'] ?? null;
$id_salle = $_POST['id_salle'] ?? null;
session_start();

$id_client = $_SESSION['client']['id_client'] ?? null;
if ($id_client === null) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté."]);
    exit;
}
try {
    $result = $daoReservation->addReservation($id_client, $id_representation, $id_salle);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Réservation réussie."]);
    } else {
        echo json_encode(["success" => false, "message" => "Échec de la réservation."]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>
