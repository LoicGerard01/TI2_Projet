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


}