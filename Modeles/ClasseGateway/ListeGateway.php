<?php

class ListeGateway {

    private Connection $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }  

   
    public function getAll(){
        $query = "SELECT * FROM liste";
        $this->con->executeQuery($query);  

        $result = $this->con->getResults();
        $tab_Liste = [];
        foreach($result as $row){
            $tab_Liste[] = new Liste($row["id"], $row["nom"]);
        }

        return $tab_Liste;
    }
     

    public function createNewListe($id, $nom){
        $query = "INSERT INTO Liste VALUES(:id, :nom)";

        $this->con->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR)
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