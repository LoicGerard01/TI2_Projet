<?php
// Traitement du formulaire
if (isset($_POST['login_submit'])) {
    extract($_POST, EXTR_OVERWRITE); // Extrait les données du formulaire
    $adm = new AdminDAO($cnx); // Initialise l'objet AdminDAO
    $admin = $adm->getAdmin($login, $password); // Récupère l'admin

    if ($admin) {
        $_SESSION['admin'] = $admin; // Définir la session
        header('Location: ./admin/index_.php?page=accueil_admin.php');
        exit(); // Terminer le script après la redirection
    } else {
        $error_message = "Identifiants incorrects"; // Message d'erreur
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Connexion Admin</h1>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password1" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="login_submit">Connexion</button>
    </form>
</div>
</body>
</html>