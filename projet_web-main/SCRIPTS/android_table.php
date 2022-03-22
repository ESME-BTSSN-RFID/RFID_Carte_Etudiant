<?php
require_once('Modele.php');


$cnx= Connexion("localhost", "projet_btssnir", "connect", "Projet_BTS2SNIR");
    
$req = "SELECT nom, prenom FROM eleve WHERE idClass=1";
$result=requeteSelect($cnx, $req);

$result = $result->fetchAll();

echo json_encode($result); 


?>