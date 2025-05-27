<?php

class Reservation
{
    private $_attributs = array();

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $champ => $valeur) {
            $this->$champ = $valeur;
        }
    }

    public function __get($champ)
    { //champ = clé
        if (isset($this->_attributs[$champ])) {
            return $this->_attributs[$champ];
        }
    }

    public function __set($champ, $valeur)
    {
        $this->_attributs[$champ] = $valeur;
    }

    public function getId_reservation()
    {
        return $this->_attributs['id_reservation'];
    }
    public function getId_client()
    {
        return $this->_attributs['id_client'];
    }
    public function getId_representation()
    {
        return $this->_attributs['id_representation'];
    }
    public function getId_salle()
    {
        return $this->_attributs['id_salle'];
    }
    public function getDate_reservation()
    {
        return $this->_attributs['date_reservation'];
    }
    public function getDate_representation()
    {
        return $this->_attributs['date_representation'];
    }
    public function getNum_salle()
    {
        return $this->_attributs['num_salle'];
    }
    public function getCapacite()
    {
        return $this->_attributs['capacite'];
    }
    public function getClient_nom()
    {
        return $this->_attributs['client_nom'];
    }
    public function getClient_prenom()
    {
        return $this->_attributs['client_prenom'];
    }
    public function getClient_email()
    {
        return $this->_attributs['client_email'];
    }
    public function getClient_mobile()
    {
        return $this->_attributs['client_mobile'];
    }




}
