<?php


class TacheGateway {

    private Connection $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }
    
    //public function deleteTache(String $nomDeLaliste, $Nom){}
    //public function modifDescription(String $nom, String $nomDeLaListe, String $nouvelledescription)

    public function createTache(String $description, String $idListe, $termine){
        $query = "INSERT INTO Tache VALUES(:id, :description, :idListe, :termine)";

        $this->con->executeQuery($query, array(
            ':id' => array(NULL, PDO::PARAM_INT),
            ':description' => array($description, PDO::PARAM_STR),
            ':idListe' => array($idListe, PDO::PARAM_STR),
            ':termine' => array($termine, PDO::PARAM_INT)
        ));

        return $this->con->getResults();
    }

    public function deleteTache(String $id){
        if ($id != NULL){
            $query = 'DELETE FROM tache WHERE id=:id';

            $this->con->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_STR)
            ));
        }
    }

    public function getAll(){
        $query = "SELECT * FROM tache";
        $this->con->executeQuery($query);  

        $result = $this->con->getResults();
        $tab_News = [];
        foreach($result as $row){
            $tab_News[] = new Tache($row["id"], $row["description"], $row["idListe"], $row["termine"]);
        }

        return $tab_News;
    }

    public function getNombreTaches(){
        $query = 'SELECT count(*) nb FROM tache';

        $this->con->executeQuery($query);  
        $result = $this->con->getResults();

        $tab_nb = [];
        foreach($result as $row){
            $tab_nb[] = $row["nb"];
        }
        
        return $tab_nb;
    }

    public function getCon(){
        return $this->con;
    }

    public function modifTache($idTache){
        $query = "UPDATE tache SET termine=:termine WHERE id=:idTache";
        $this->con->executeQuery($query, array(
            ':termine' => array(1, PDO::PARAM_INT),
            ':idTache' => array($idTache, PDO::PARAM_INT),
        ));  

        $result = $this->con->getResults();
        return $result;
    }
    
}


?>