<?php

class SalleDAO
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }
    public function getSalles()
    {
        $query = "select * from salle";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            foreach ($data as $d) {
                $_array[] = new Salle($d);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }

            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }
    public function getSalleById()
    {
        $query = "select * from salle where id_salle = :id_salle";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':id_salle', $_GET['id_salle']);
            $resultset->execute();
            $data = $resultset->fetchAll();
            foreach ($data as $d) {
                $_array[] = new Salle($d);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }

            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }
}