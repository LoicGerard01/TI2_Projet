<?php
if (!isset($_SESSION['client'])) {
    header("Location: ../index_.php?page=accueil.php");
}

