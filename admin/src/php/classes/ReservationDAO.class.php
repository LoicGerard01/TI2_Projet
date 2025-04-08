<?php

class ReservationDAO
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function add_representation($id_representation,$titre,$type,$date_representation,$image,$salle){
        $query = "SELECT ajouter_representation(:id_representation, :titre, :type, :date_representation, :image, :salle) as retour";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_representation', $id_representation);
            $stmt->bindValue(':titre', $titre);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':date_representation', $date_representation);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':salle', $salle);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }
    }

    public function update_representation($id_representation,$titre,$type,$date_representation,$image,$salle){
        $query = "SELECT modifier_representation(:id_representation, :titre, :type, :date_representation, :image, :salle) as retour";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_representation', $id_representation);
            $stmt->bindValue(':titre', $titre);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':date_representation', $date_representation);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':salle', $salle);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }
    }
}