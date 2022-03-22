<?php
require_once('Modele.php');

$idCand=$_GET['idCarteEtudiant'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$classe=$_GET['idClass'];



if (empty($idCand) || empty($nom) || empty($prenom) || empty($classe)) {
    header("Location: ../PAGES/Ajouter.php?error=Veuillez compléter tous les champs&idCarteEtudiant=$idCand&nom=$nom&prenom=$prenom&idClass=$classe");
    exit();
}
else {
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req = "INSERT INTO eleve VALUES ('$idCand', '$nom', '$prenom', '$classe')";
    $result=requeteSelect($cnx, $req);
  
    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne ajoutée");
}

?>