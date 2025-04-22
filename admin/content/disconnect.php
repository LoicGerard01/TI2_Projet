<?php
if (isset($_SESSION['client'])) {
    session_destroy();
    header("Location: projet/index_.php?page=accueil.php");
} elseif (isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index_.php?page=accueil.php");
} else {
    // Par défaut, si aucun utilisateur connecté
    session_destroy();
    header("Location: projet/index_.php?page=accueil.php");
}
?>
