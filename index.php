<?php

//chargement config
require_once(__DIR__.'/Config/config.php');
require_once(__DIR__.'/Config/Autoload.php');

Autoload::charger();

//require_once(__DIR__.'/Modeles/ClasseGateway/tacheGateway.php');

//$tache = new TacheGateway(new Connection($dsn, $user, $pass));

$controllerUser = new ControllerVisiteur();



?>
