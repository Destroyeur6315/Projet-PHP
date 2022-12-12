<?php

//require_once(__DIR__.'../ClassesMetiers/connection.php');
//require_once(__DIR__.'../ClassesMetiers/tache.php');

class TacheGateway {

    private Connection $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }
    
    //public function deleteTache(String $nomDeLaliste, $Nom){}
    //public function modifDescription(String $nom, String $nomDeLaListe, String $nouvelledescription)

    public function createTache(String $id, String $description, String $idListe){
        $query = "INSERT INTO Tache VALUES(:id, :description, :idListe)";

        $this->con->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':idListe' => array($idListe, PDO::PARAM_STR)
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
            $tab_News[] = new Tache($row["id"], $row["description"], $row["idListe"]);
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
    
}


?>