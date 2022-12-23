<?php

//require_once(__DIR__.'../ClassesMetiers/connection.php');
//require_once(__DIR__.'../ClassesMetiers/tache.php');

class Model{

    public function __construct(){}


    // fonction pour les tâches
    public function get_AllTache(){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));     
        $tab_taches = $Taches->getAll();
    
        return $tab_taches;
    }

    public function insertTache(String $idListe, String $description){
        global $dsn, $user, $pass;
        $termine = 0;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $result = $Taches->createTache($description, $idListe, $termine);

        return $result;
    }

    public function suppTache(String $idTache){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $result = $Taches->deleteTache($idTache);
    }

    public function modifTermineTache(String $idTache){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $result = $Taches->modifTache($idTache);

        return $result;
    }


    // fonction pour les listes
    public function get_AllListe($possesseur){
        global $dsn, $user, $pass;

        $Liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $Liste->getAll($possesseur);

        return $result;
    }

    public function suppListe(String $idListe){
        global $dsn, $user, $pass;


        $liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $liste->deleteListe($idListe);

    }

    public function insertListe($nomListe, $possesseur){
        global $dsn, $user, $pass;

        $Liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $Liste->createNewListe($nomListe, $possesseur);

        return $result;
    }
}


?>