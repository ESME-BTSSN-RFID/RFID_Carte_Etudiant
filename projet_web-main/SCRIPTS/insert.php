<?php
require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

$idCand=$_GET['idCarteEtudiant'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$classe=$_GET['idClass'];



if (empty($idCand) || empty($nom) || empty($prenom) || empty($classe)) {
    header("Location: ../PAGES/Ajouter.php?error=Veuillez compléter tous les champs&idCarteEtudiant=$idCand&nom=$nom&prenom=$prenom&idClass=$classe");
    exit();
}
else {
    $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
    $req = "INSERT INTO eleve VALUES ('$idCand', '$nom', '$prenom', '$classe')";
    $result=requeteSelect($cnx, $req);
  
    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne ajoutée");
}

?>