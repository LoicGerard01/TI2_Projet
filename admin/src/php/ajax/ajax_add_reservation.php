<?php
header('Content-Type: application/json');

require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/ReservationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$dao = new ReservationDAO($cnx);


$id_client = $_SESSION['client']['id_client'];
$id_representation = (int)$_POST['id_representation'];
$id_salle = (int)$_POST['id_salle'];

// Appel DAO pour l'ajout
$id_reservation = $dao->addReservation($id_client, $id_representation, $id_salle);

// Réponse JSON
if ($id_reservation > 0) {
    echo json_encode(['success' => true, 'id_reservation' => $id_reservation]);
} else {
    echo json_encode(['success' => false, 'message' => 'Échec de la réservation.']);
}
