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

    public function addClient($nom_client, $prenom_client, $email, $password, $mobile){
        $query = "INSERT INTO client(nom_client, prenom_client, email, password, mobile) 
              VALUES (:nom_client, :prenom_client, :email, :password, :mobile)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom_client', $nom_client);
            $stmt->bindValue(':prenom_client', $prenom_client);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':mobile', $mobile);
            $stmt->execute();

            $id = $this->_bd->lastInsertId();
            $this->_bd->commit();

            // récupérer le client inséré
            $query2 = "SELECT * FROM client WHERE id_client = :id";
            $stmt2 = $this->_bd->prepare($query2);
            $stmt2->bindValue(':id', $id);
            $stmt2->execute();
            $clientData = $stmt2->fetch(PDO::FETCH_ASSOC);

            return $clientData;

        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Échec de la requête : " . $e->getMessage();
            return null;
        }
    }

}