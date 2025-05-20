<?php

class Vue_reservationsDAO{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getAllReservations(){
        $sql = "SELECT * from vue_reservation_client";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Vue_reservations($data);
        }
        return $this->_array;
    }

    public function getReservationById($id){
        $sql = "SELECT * from vue_reservation_client WHERE id_reservation = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Vue_reservations($data);
    }

    public function getReservationsByClient($id_client)
    {
        $sql = "SELECT * FROM vue_reservation_client WHERE id_client = :id_client AND date_representation > NOW()";
        $result = $this->_bd->prepare($sql);
        $result->bindValue(':id_client', $id_client);
        $result->execute();
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Vue_reservations($data);
        }
        return $this->_array;
    }


    public function getId_reservation()
    {
        return $this->_id_reservation;
    }

    public function getDate_reservation()
    {
        return $this->date_reservation;
    }
    public function getId_client()
    {
        return $this->id_client;
    }
    public function getClient_nom()
    {
        return $this->client_nom;
    }
    public function getClient_prenom()
    {
        return $this->client_prenom;
    }
    public function getClient_email()
    {
        return $this->client_email;
    }
    public function getClient_mobile()
    {
        return $this->client_mobile;
    }
    public function getId_representation()
    {
        return $this->id_representation;
    }
    public function getTitre()
    {
        return $this->titre;
    }

    public function getDate_representation()
    {
        return $this->date_representation;
    }
    public function getId_salle()
    {
        return $this->id_salle;
    }
    public function getNum_salle()
    {
        return $this->num_salle;
    }

}