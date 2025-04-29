<?php
/*
 vue :
CREATE OR REPLACE VIEW vue_reservation_client AS
SELECT
    r.id_reservation,
    r.date_reservation,
    c.id_client,
    c.nom_client AS client_nom,
    c.prenom_client AS client_prenom,
    c.email AS client_email,
	c.mobile AS client_mobile,
    re.id_representation,
	re.titre,
    re.date_representation,
    s.id_salle,
    s.num_salle AS num_salle
FROM
    reservation r
JOIN
    client c ON r.id_client = c.id_client
JOIN
    representation re ON re.id_representation = r.id_representation
JOIN
    salle s ON s.id_salle = re.salle;
 */

class Vue_reservations{
    private $_id_reservation;
    private $date_reservation;
    private $id_client;
    private $client_nom;
    private $client_prenom;
    private $client_email;
    private $client_mobile;
    private $id_representation;
    private $titre;
    private $date_representation;
    private $id_salle;
    private $num_salle;

    public function __construct(array $data)
    {
        $this->_id_reservation = $data['id_reservation'];
        $this->date_reservation = $data['date_reservation'];
        $this->id_client = $data['id_client'];
        $this->client_nom = $data['client_nom'];
        $this->client_prenom = $data['client_prenom'];
        $this->client_email = $data['client_email'];
        $this->client_mobile = $data['client_mobile'];
        $this->id_representation = $data['id_representation'];
        $this->titre = $data['titre'];
        $this->date_representation = $data['date_representation'];
        $this->id_salle = $data['id_salle'];
        $this->num_salle = $data['num_salle'];
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