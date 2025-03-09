<?php
// checker si la connexion existe et rediriger sinon
if(!isset($_SESSION['admin'])){
header('location: index_.php?page=accueil.php');
}