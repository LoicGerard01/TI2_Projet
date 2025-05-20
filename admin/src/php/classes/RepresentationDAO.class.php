<!-- RepresentationDAO.class.php -->

<?php

class RepresentationDAO
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function update_ajax_representation($champ, $valeur, $id)
    {
        $query = "SELECT update_ajax_representation(:champ, :valeur, :id_representation)";

        try {
            // Démarrer une transaction
            $this->_bd->beginTransaction();

            // Préparer la requête SQL avec des paramètres nommés
            $stmt = $this->_bd->prepare($query);

            // Lier les valeurs des paramètres
            $stmt->bindValue(':id_representation', $id);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur', $valeur);

            // Exécuter la requête
            $stmt->execute();

            // Commit la transaction si tout s'est bien passé
            $this->_bd->commit();

            return true; // Retourne true si la mise à jour est réussie
        } catch (PDOException $e) {
            // Rollback en cas d'erreur
            $this->_bd->rollBack();

            // Log de l'erreur
            print $e->getMessage();

            return false; // Retourne false en cas d'erreur
        }
    }


    public function delete_representation($id)
    {
        $query = "SELECT delete_representation(:id_representation)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_representation', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function add_representation($titre, $type, $date, $image, $salle, $description, $prix)
    {
        $query = "SELECT ajout_representation(:titre, :type, :date, :image, :salle, :description , :prix) as retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':titre', $titre);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':salle', $salle);
            $stmt->bindValue(':description', $description);  // Nouvelle valeur
            $stmt->bindValue(':prix', $prix);  // Nouvelle valeur
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return -1;
        }
    }


    public function update_representation($id, $titre, $type, $date, $image, $salle, $description, $prix)
    {
        $query = "SELECT update_representation(:id, :titre, :type, :date, :image, :salle, :description , :prix) as retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':titre', $titre);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':salle', $salle);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':prix', $prix);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Echec : " . $e->getMessage();
            return -1;
        }
    }


    public function ajax_get_representation($titre)
    {
        $query = "SELECT * FROM representation WHERE titre = :titre";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':titre', $titre);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->_bd->commit();
            return $stmt->rowCount() > 0 ? $result : null;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return -1;
        }
    }

    public function getAllRepresentations()
    {
        $query = "SELECT * FROM representation ORDER BY date_representation";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->_bd->commit();
            return $result;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return null;
        }
    }

    public function getRepresentationByID($id)
    {
        $query = "SELECT * FROM representation WHERE id_representation = :id";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->_bd->commit();
            return $result;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return null;
        }
    }
}