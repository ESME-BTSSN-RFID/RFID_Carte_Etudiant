<?php
session_start();
$val=$_SESSION['val'];

require_once('Modele.php');

$idCarteEtudiant=$_GET['idCarteEtudiant'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$idClass=$_GET['idClass'];

if (empty($idCarteEtudiant) || empty($nom) || empty($prenom) || empty($idClass)) {
    header("Location: ../PAGES/Modifier.php?error=Veuillez compléter tous les champs&val=$val&idCarteEtudiant=$idCarteEtudiant&nom=$nom&prenom=$prenom&idClass=$idClass");
    exit();
}
else{
    $cnx= Connexion("localhost", "projet_btssnir", "root", "");
    $req = "UPDATE eleve SET nom='$nom', prenom='$prenom', idClass=$idClass WHERE idCarteEtudiant='$idCarteEtudiant'";
    $result=requeteSelect($cnx, $req);

    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne modifiée");
    
}
?>