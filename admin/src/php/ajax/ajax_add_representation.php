<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$dao = new RepresentationDAO($cnx);

$titre = $_POST['titre'] ?? '';
$type = $_POST['type'] ?? '';
$date = $_POST['date'] ?? '';
$image = $_POST['image'] ?? '';
$salle = $_POST['salle'] ?? '';
$id = $_POST['id_representation'] ?? null;

try {
    if ($id != "") {
        $retour = $dao->update_representation($id, $titre, $type, $date, $image, $salle);
        echo json_encode(["success" => true, "operation" => "update", "id" => $id]);
    } else {
        $retour = $dao->add_representation($titre, $type, $date, $image, $salle);
        echo json_encode(["success" => true, "operation" => "insert", "id" => $retour]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
