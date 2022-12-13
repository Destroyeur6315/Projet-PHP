<?php

class Tache{

    private $id;
    private $description;
    private $idListe;

    public function __construct(int $id, String $description, String $idListe){
        $this->id = $id;
        $this->description = $description;
        $this->idListe= $idListe;
    }

    public function getId() : String {
        return $this->id;
    }

    public function getIdListe() : String {
        return $this->idListe;
    }

    public function getDescription() : String {
        return $this->description;
    }
}


?>