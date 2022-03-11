<?php
// if text data was posted

require_once("Modele.php");


$log = $_POST["login"];
$password = $_POST["password"];

$cnx = Connexion("10.10.10.70", "projet_btssnir", "connect", "Projet_BTS2SNIR");
#$req = "INSERT INTO `utilisateur` (`login`, `password`) VALUES ($log, $password)";
$req="SELECT COUNT(*) FROM utilisateur WHERE login='$log' AND password='$password'";
$result=requeteSelect($cnx, $req);

foreach($result as $key => $value){
    print_r($value[0]);
}

?>