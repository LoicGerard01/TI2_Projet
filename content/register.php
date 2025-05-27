<?php
if (isset($_POST['register_submit'])) {
    extract($_POST, EXTR_OVERWRITE);

    $clientDao = new ClientDAO($cnx);

    if ($clientDao->emailExists($email)) {
        $erreur = "Cette adresse e-mail est déjà utilisée. Veuillez en choisir une autre.";
    } else {
        $client = $clientDao->addClient($nom_client, $prenom_client, $email, $password, $mobile);

        if ($client) {
            $_SESSION['client'] = $client;
            header('location: index_.php?page=accueil_client.php');
            exit();
        } else {
            $erreur = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}

?>

<?php if (isset($erreur)) { ?>
    <div class="alert alert-danger"><?php echo $erreur; ?></div>
<?php } ?>
<h3>Inscription</h3>

<form method="post" action="">
    <div class="mb-3">
        <label for="nom_client" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom_client" name="nom_client" required>
    </div>
    <div class="mb-3">
        <label for="prenom_client" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom_client" name="prenom_client" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile" required>
    </div>
    <button type="submit" class="btn btn-primary" name="register_submit">S'inscrire</button>
</form>

