<?php

class Client
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

    public function getId_client()
    {
        return $this->_attributs['id_client'];
    }
    public function getClient_nom()
    {
        return $this->_attributs['nom_client'];
    }
    public function getClient_prenom()
    {
        return $this->_attributs['prenom_client'];
    }
    public function getClient_email()
    {
        return $this->_attributs['email'];
    }
    public function getClient_mobile()
    {
        return $this->_attributs['mobile'];
    }
}
