<?php

//require_once(__DIR__.'../ClassesMetiers/connection.php');
//require_once(__DIR__.'../ClassesMetiers/tache.php');

class Model{

    public function __construct(){
        
    }

    // fonction pour les tâches

    // obtenir toutes les tâches
    public function get_AllTache(){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $tab_taches = $Taches->getAll();

        return $tab_taches;
    }

    public function insertTache(String $idListe, String $description){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $result = $Taches->createTache($description, $idListe);

        return $result;
    }

    public function suppTache(String $idTache){
        global $dsn, $user, $pass;

        $Taches = new TacheGateway(New Connection($dsn, $user, $pass));
        $result = $Taches->deleteTache($idTache);
    }

    // fonction pour les listes

    // obtenir toutes les listes

    public function get_AllListe(){
        global $dsn, $user, $pass;

        $Liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $Liste->getAll();

        return $result;
    }

    public function suppListe(String $idListe){
        global $dsn, $user, $pass;


        $liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $liste->deleteListe($idListe);

    }

    public function insertListe($nomListe){
        global $dsn, $user, $pass;

        $Liste = new ListeGateway(New Connection($dsn, $user, $pass));
        $result = $Liste->createNewListe($nomListe);

        return $result;
    }
}


?>