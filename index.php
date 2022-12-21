<?php

//chargement config
require_once(__DIR__.'/Config/config.php');
require_once(__DIR__.'/Config/Autoload.php');

Autoload::charger();

$frontController = new FrontController();


?>
