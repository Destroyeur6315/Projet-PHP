<?php

class Liste{
    private $id;
    private $nom;
    private $listeDeTaches = [];

    public function __construct(String $id, String $nom){
        $this->nom = $nom;
        $this->id = $id;
    }

    public function getNom() : String {
        return $this->nom;
    }

    public function getId() : String {
        return $this->id;
    }

    public function getListe() : array {
        return $this->listeDeTaches;
    }
}


?>