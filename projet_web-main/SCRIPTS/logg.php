<?php
// if text data was posted

require_once("Modele.php");


$log = $_POST["login"];
$password = $_POST["password"];


$cnx = Connexion("10.4.253.110", "projet_btssnir", "connect", "Projet_BTS2SNIR");
#$req = "INSERT INTO `utilisateur` (`login`, `password`) VALUES ($log, $password)";
$req="SELECT COUNT(*) FROM utilisateur";
$result=requeteSelect($cnx, $req);



?>