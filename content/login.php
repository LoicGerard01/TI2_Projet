<?php
if(isset($_POST['login_submit'])){
    extract($_POST, EXTR_OVERWRITE);

    $adm = new AdminDAO($cnx);
    $nom_admin = $adm->getAdmin($login, $password);

    if($nom_admin) {
        $_SESSION['admin'] = $nom_admin;
        header('location: admin/index_.php?page=accueil_admin.php');
        exit();
    } else {
        $clientDao = new ClientDAO($cnx);
        $email = $clientDao->getClient($login, $password);

        if($email) {
            $_SESSION['client'] = $email;
            header('location: index_.php?page=accueil.php');
            exit();
        } else {
            $erreur = "Login ou mot de passe incorrect";
        }
    }
}
?>


<?php if(isset($erreur)) { ?>
    <div class="alert alert-danger"><?php echo $erreur; ?></div>
<?php } ?>
<form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
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

