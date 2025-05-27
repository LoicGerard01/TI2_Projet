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

    // fonction pour récupérer les trois prochaines représentation ( page d'accueil)
    public function getUpcomingRepresentations(){
        $sql = "SELECT * from vue_representations_a_venir ORDER BY date_representation LIMIT 3";
        $result = $this->_bd->query($sql);
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Vue_representations($data);
        }
        return $this->_array;
    }
    // fonction pour rechercher un représentation avec le titre ou le type
    public function getFilteredRepresentations($search){
        $sql = "SELECT * from vue_representations_a_venir WHERE titre LIKE :search OR type LIKE :search";
        $stmt = $this->_bd->prepare($sql);
        $stmt->execute(['search' => '%' . $search . '%']);
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->_array[] = new Vue_representations($data);
        }
        return $this->_array;
    }

    public function getRepresentationById($id){
        $sql = "SELECT * from vue_representations_a_venir WHERE id_representation = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Vue_representations($data);
    }

    // pour la recherche dans la navbar
    public function searchByTitle($query) {
        $sql = "SELECT * FROM vue_representations_a_venir WHERE titre LIKE :query ORDER BY date_representation";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        try {
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];

            foreach ($rows as $row) {
                $result[] = new Vue_representations($row);
            }


            return $result;
        } catch (PDOException $e) {
            error_log('Erreur SQL : ' . $e->getMessage());
            return [];
        }
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