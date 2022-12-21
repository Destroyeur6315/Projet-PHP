<?php

class Utilisateur{
    private $pseudo;
    //private $password;

    public function __construct(String $pseudo){
        $this->pseudo = $pseudo;
    }

    public function getPseudo() : String {
        return $this->pseudo;
    }
}


?>