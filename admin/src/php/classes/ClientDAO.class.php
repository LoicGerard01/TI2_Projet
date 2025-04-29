<?php

class ClientDAO
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getClient($email, $password)
    {
        $query = "SELECT * FROM client WHERE email = :email AND password = :password";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':email', $email);
            $resultset->bindValue(':password', $password);
            $resultset->execute();

            $nom = $resultset->fetch(PDO::FETCH_ASSOC);

            $this->_bd->commit();
            return $nom;
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Échec de la requête : " . $e->getMessage();
            return null;
        }
    }

}