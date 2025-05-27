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
        $sql = "SELECT * FROM reservation";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Reservation($data);
        }
        return $this->_array;
    }
    public function getReservationsByClient($id_client)
    {
        $sql = "SELECT * FROM reservation WHERE id_client = :id_client AND date_representation > NOW()";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Reservation($data);
        }
        return $this->_array;
    }

    public function addReservation($id_client, $id_representation, $id_salle) {
        $query = "SELECT ajout_reservation(:id_client, :id_representation, :id_salle) AS id_reservation";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindParam(':id_client', $id_client);
        $stmt->bindParam(':id_representation', $id_representation);
        $stmt->bindParam(':id_salle', $id_salle);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['id_reservation'] > 0) {
            return true;
        } else {
            return false;
        }
    }






}