<?php

class Liste{
    private $id;
    private $nom;
    private $User;

    public function __construct(int $id, String $nom, String $User){
        $this->nom = $nom;
        $this->id = $id;
        $this->User = $User;
    }

    public function getNom() : String {
        return $this->nom;
    }

    public function getId() : String {
        return $this->id;
    }

    public function getIdUser() : String {
        return $this->User;
    }
}


?>