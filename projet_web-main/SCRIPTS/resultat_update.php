<?php
session_start();

$idSeance=$_SESSION['idSeance'];

require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');


$classe=$_GET['idClass'];
$cours=$_GET['idCours'];
$prof=$_GET['idProf'];
$salle=$_GET['idSalle'];
$debut=$_GET['heureDebut'];
$duree=$_GET['duree'];


if (empty($classe) || empty($cours) || empty($prof)|| empty($salle) || empty($debut) || empty($duree)) {
    header("Location: ../PAGES/Resultat_Modifier.php?error=Veuillez compléter tous les champs&idSeance=$seance&cours=$idCours&idProf=$prof&idSalle=$salle&heureDebut=$debut&duree=$duree");
    exit();
}
else{   
    //echo 'b';
    $new_hour = intval(substr($debut, -5, 2)) + $duree;
    $fin = str_replace(substr($debut, -5, 2), $new_hour, $debut);

    $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
    $req="UPDATE seance SET idClass='$classe', idCours='$cours', idProf='$prof', idSalle='$salle', heureDebut='$debut', heureFin='$fin', duree='$duree' WHERE idSeance='$idSeance'";
    //echo $req;
    $result=requeteSelect($cnx, $req);

    header("Location: ../PAGES/Visu_tab_R.php?succes=Une ligne modifiée");
}



?>