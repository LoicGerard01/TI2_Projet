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


}