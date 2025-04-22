
<h2>Accueil</h2>
<?php

if (isset($_SESSION['client'])) {
    echo 'Bienvenue ',$_SESSION['client'];
} else {
    echo "<h3>Bienvenue sur notre site</h3>";
}