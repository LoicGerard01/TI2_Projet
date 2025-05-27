<?php
header('Content-Type: application/json');

require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Representation.class.php';
require '../classes/RepresentationDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$representation = new RepresentationDAO($cnx);
$tab = $representation->update_ajax_representation($_GET['champ'], $_GET['valeur'], $_GET['id_representation']);

print (json_encode($tab));

