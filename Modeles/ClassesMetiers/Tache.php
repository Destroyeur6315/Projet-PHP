<?php

class Tache{

    private $id;
    private $description;
    private $idListe;
    private int $termine;

    public function __construct(int $id, String $description, String $idListe, int $termine){
        $this->id = $id;
        $this->description = $description;
        $this->idListe= $idListe;
        $this->termine = $termine;
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

    public function getTermine(){
        return $this->termine;
    }
}


?>