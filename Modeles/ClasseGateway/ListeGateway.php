<?php

class ListeGateway {

    private Connection $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }  

    public function getAll($possesseur){
        $query = "SELECT * FROM liste WHERE possesseur=:possesseur";

        $this->con->executeQuery($query, array(
            ':possesseur' => array($possesseur, PDO::PARAM_STR)
        ));  

        $result = $this->con->getResults();

        $tab_Liste = [];
        foreach($result as $row){
            $tab_Liste[] = new Liste($row["id"], $row["nom"], $row["possesseur"]);
        }

        return $tab_Liste;
    }
     

    public function createNewListe($nom, $possesseur){
        $query = "INSERT INTO Liste VALUES(:id, :nom, :user)";

        $this->con->executeQuery($query, array(
            ':id' => array(NULL, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':user' => array($possesseur, PDO::PARAM_STR),
        ));

        return $this->con->getResults();
    }

    
    public function deleteListe(String $id){
        if ($id != NULL){
            $query = 'DELETE FROM liste WHERE id=:id';

            $this->con->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_STR)
            ));
        }
    }

    public function getNombreListe(){
        $query = 'SELECT count(*) nb FROM liste';

        $this->con->executeQuery($query);  
        $result = $this->con->getResults();

        $tab_nb = [];
        foreach($result as $row){
            $tab_nb[] = $row["nb"];
        }
        
        return $tab_nb;
    }
}


?>