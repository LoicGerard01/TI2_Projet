<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/SalleDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

if (isset($_GET['id_salle']) && is_numeric($_GET['id_salle'])) {
    $salleDAO = new SalleDAO($cnx);
    $salle = $salleDAO->getSalleById((int)$_GET['id_salle']);
    echo json_encode($salle);
} else {
    echo json_encode([]);
}
?>
