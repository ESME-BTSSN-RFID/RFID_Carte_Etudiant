<?php

require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');


$cnx= Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
    
$req = "SELECT nom, prenom FROM eleve WHERE idClass=1";
$result=requeteSelect($cnx, $req);

$result = $result->fetchAll();

echo json_encode($result);


?>