<?php
header('Content-Type: application/json');

require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$dao = new RepresentationDAO($cnx);

// Sécurité de base : vérifier que tous les paramètres sont bien là
if (isset($_GET['champ'], $_GET['valeur'], $_GET['id_representation'])) {
    $champ = $_GET['champ'];
    $valeur = $_GET['valeur'];
    $id = $_GET['id_representation'];

    $result = $dao->update_ajax_representation($champ, $valeur, $id);
    echo json_encode(['success' => true, 'champ' => $champ, 'valeur' => $valeur, 'id' => $id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
}
