<?php
session_start();
$idCand_resultat=$_SESSION['idCand_resultat'];

require_once('Modele.php');

$seance=$_GET['idSeance'];
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

    $new_hour = intval(substr($debut, -5, 2)) + $duree;
    $fin = str_replace(substr($debut, -5, 2), $new_hour, $debut);

    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req="UPDATE seance SET idClass='$classe', idCours='$cours', idProf='$prof', idSalle='$salle', heureDebut='$debut', heureFin='$fin', duree='$duree' WHERE idSeance='$seance'";
    $result=requeteSelect($cnx, $req);

    header("Location: ../PAGES/Visu_tab_R.php?succes=Une ligne modifiée$seance");
}



?>