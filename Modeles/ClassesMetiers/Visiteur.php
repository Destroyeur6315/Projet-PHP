<?php

class Visiteur{
    private static $nbUser = 0;
    private $id;

    public function __construct(){
        $this->id = $this->nbUser;
        $this->nbUser = $this->nbUser + 1;
    }

    public function getId() : String {
        return $this->id;
    }
}


?>