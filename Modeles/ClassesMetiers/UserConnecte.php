<?php

class UserConnecte extends User{
    private $pseudo;
    private $password;

    public function __construct(String $pseudo, $password){
        $this->pseudo = $pseudo;
        $this->password = $password;
    }

    public function getId() : String {
        return $nom;
    }

}


?>