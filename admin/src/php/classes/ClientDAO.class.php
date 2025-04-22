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
        $query = "SELECT get_client(:email, :password) AS nom";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':email', $email);
            $resultset->bindValue(':password', $password);
            $resultset->execute();

            $email = $resultset->fetchColumn(0);

            $this->_bd->commit();
            return $email;
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Échec de la requête : " . $e->getMessage();
            return null;
        }
    }

}