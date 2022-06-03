<?php
require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

header('Content-type: application/x-www-form-urlencoded');

$data = $_POST['data'];


$cnx= Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
$req = "INSERT INTO `scan` (`id`, `uid`, `time`) VALUES (NULL, '$data', CURRENT_TIMESTAMP)";
$result=requeteSelect($cnx, $req);








?>