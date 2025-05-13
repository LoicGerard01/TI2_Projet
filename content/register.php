<!--     public function addClient($nom_client, $prenom_client, $email, $password, $mobile){
        $query = "INSERT INTO client(nom_client, prenom_client, email, password, mobile) VALUES (:nom_client, :prenom_client, :email, :password, :mobile)";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':nom_client', $nom_client);
            $resultset->bindValue(':prenom_client', $prenom_client);
            $resultset->bindValue(':email', $email);
            $resultset->bindValue(':password', $password);
            $resultset->bindValue(':mobile', $mobile);
            $resultset->execute();

            $this->_bd->commit();
            return 1;
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Échec de la requête : " . $e->getMessage();
            return null;
        }
    } -->
<?php
if (isset($_POST['register_submit'])) {
    extract($_POST, EXTR_OVERWRITE);

    $clientDao = new ClientDAO($cnx);
    $client = $clientDao->addClient($nom_client, $prenom_client, $email, $password, $mobile);

    if ($client) {
        $_SESSION['client'] = $client; // contient toutes les infos du client
        header('location: index_.php?page=accueil_client.php');
        exit();
    } else {
        $erreur = "Erreur lors de l'inscription";
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
        <input type="email" class="form-control" id="email" name="email" required>
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

