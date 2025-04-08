<?php
// RepresentationDAO.class.php

class RepresentationDAO
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajax_get_representation($nom)
    {
        $query = "SELECT * FROM representation where nom_representation = :nom";
        try {
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(":nom", $nom);
            $resultset->execute();
            $_array = $resultset->fetchAll();
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }
    }

    public function add_representation($id_representation,$titre,$type,$date_representation,$image,$salle){
        $query = "SELECT ajout_representation(:id_representation, :titre, :type, :date_representation, :image, :salle) as retour";
        try {
            // Check if a transaction is already active
            if (!$this->_bd->inTransaction()) {
                $this->_bd->beginTransaction();
            }

            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_representation', $id_representation);
            $stmt->bindValue(':titre', $titre);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':date_representation', $date_representation);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':salle', $salle);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);

            // Only commit if we started the transaction
            if ($this->_bd->inTransaction()) {
                $this->_bd->commit();
            }

            return $retour;
        } catch (PDOException $e) {
            // Only rollback if we're in a transaction
            if ($this->_bd->inTransaction()) {
                $this->_bd->rollBack();
            }
            print $e->getMessage();
        }
    }

    public function getRepresentationByTitre($titre)
    {
        $query = "SELECT * FROM representation WHERE titre = :titre";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':titre', $titre);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }
    }
}