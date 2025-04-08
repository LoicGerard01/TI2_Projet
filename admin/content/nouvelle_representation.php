<?php
// nouvelle_mission.php

//récupération des données
$title = "Nouvelle mission";
$salle = new SalleDAO($cnx);
$liste_s = $salle->getSalles();
$nbr_p = 0;
$salle_choisie = "";

if ($liste_s != NULL) {
    $nbr_p = count($liste_s);
}
//vérifier envoi du form première liste
if (isset($_GET['submit_salle']) && !empty($_GET['id_salle'])) {
    $salle = new SalleDAO($cnx);
    $liste_s = $salle->getSalleById($_GET['id_salle']);
}

if (isset($_POST['submit_salle'])){
    extract($_POST, EXTR_OVERWRITE);
    $representation = new RepresentationDAO($cnx);
    $retour = $representation->add_representation($titre,$type,$date_representation,$image,$salle);

    if($retour != -1){
        print "<br>Représentation ajoutée avec succès !</br>";
    } else {
        print "<br>Erreur lors de l'ajout de la représentation !</br>";
    }
}
?>

    <form id="form_ajout_representation" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div class="container form_nouvelle_representation" id="nouvelle_representation">
            <h2>Nouvelle représentation</h2>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" required>
            <br>
            <label for="type">Type :</label>
            <input type="text" name="type" id="type" required>
            <br>

            <label for="date_representation">Date de représentation :</label>
            <input type="date" name="date_representation" id="date_representation" required>
            <br>

            <label hidden="hidden" for="image">Image :</label>
            <input type="file" hidden="hidden" name="image" id="image">
            <br>

            <label for="salle">Salle :</label>
            <select name="salle" id="salle">
                <br>

                <?php
                foreach ($liste_s as $s) {
                    ?>
                    <option value="<?= htmlspecialchars($s->id_salle); ?>">
                        <?= htmlspecialchars($s->num_salle); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <br>

            <input type="submit" value="Ajouter la représentation" name="submit_mission">
        </div>
    </form>

<?php
if (isset($localisation)) {
    echo $localisation;
}
?>
<!--  JavaScript uniquement : -->
<div id="localisation_js"></div>