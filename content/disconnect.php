<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_destroy();

echo '<script>window.location.href = "./index_.php?page=accueil.php";</script>';
exit;