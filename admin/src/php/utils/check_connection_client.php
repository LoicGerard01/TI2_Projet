<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['client'])) {
    header("Location: index_.php?page=accueil.php");
    exit();
}
