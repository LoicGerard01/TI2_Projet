<!-- Vue_representationsDAO.class.php -->

<?php

class Vue_representationsDAO{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getAllRepresentations(){
        $sql = "SELECT * from vue_representations_a_venir";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Vue_representations($data);
        }
        return $this->_array;
    }
    public function getId_representation(){
        return $this->_id_representation;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function getType(){
        return $this->type;
    }
    public function getDate_representation(){
        return $this->date_representation;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrix(){
        return $this->prix;
    }
    public function getSalle(){
        return $this->salle;
    }
    public function getNb_sieges(){
        return $this->nb_sieges;
    }
    public function getNum_salle(){
        return $this->num_salle;
    }
}