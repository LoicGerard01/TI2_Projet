<?php

class Vue_representations{
    private $_id_representation;
    private $titre;
    private $type;
    private $date_representation;
    private $image;
    private $description;
    private $prix;
    private $salle;
    private $nb_sieges;
    private $num_salle;

    public function __construct(array $data)
    {
        $this->_id_representation = $data['id_representation'];
        $this->titre = $data['titre'];
        $this->type = $data['type'];
        $this->date_representation = $data['date_representation'];
        $this->image = $data['image'];
        $this->description = $data['description'];
        $this->prix = $data['prix'];
        $this->salle = $data['salle'];
        $this->nb_sieges = $data['nb_sieges'];
        $this->num_salle = $data['num_salle'];
    }
    public function getId_representation()
    {
        return $this->_id_representation;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getDate_representation()
    {
        return $this->date_representation;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getSalle()
    {
        return $this->salle;
    }
    public function getNb_sieges()
    {
        return $this->nb_sieges;
    }
    public function getNum_salle()
    {
        return $this->num_salle;
    }




}