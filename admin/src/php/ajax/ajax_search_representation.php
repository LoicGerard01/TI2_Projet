<?php
header('Content-Type: application/json');
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Representation.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$representation = new RepresentationDAO($cnx);

$titre = $_GET['nom_representation'] ?? '';

$data = $representation->ajax_get_representation($titre);
echo json_encode($data);
