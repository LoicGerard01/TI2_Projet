<?php

class ReservationDAO
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getAllReservations()
    {
        $sql = "SELECT * FROM reservations";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Reservation($data);
        }
        return $this->_array;
    }
    public function getReservationsByClient($id_client)
    {
        $sql = "SELECT * FROM reservations WHERE id_client = :id_client AND date_representation > NOW()";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Reservation($data);
        }
        return $this->_array;
    }

    public function addReservation($id_client, $id_representation, $id_salle) {
        $sql = "SELECT ajout_reservation(:id_client, :id_representation, :id_salle) AS id_reservation";

        try {
            $stmt = $this->_bd->prepare($sql);
            $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
            $stmt->bindValue(':id_representation', $id_representation, PDO::PARAM_INT);
            $stmt->bindValue(':id_salle', $id_salle, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id_reservation'];
        } catch (PDOException $e) {
            error_log("Erreur addReservation : " . $e->getMessage());
            return -1;
        }
    }




}