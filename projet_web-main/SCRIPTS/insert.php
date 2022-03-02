<?php
require_once('Modele.php');

$idCand=$_GET['idCarteEtudiant'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
//$date=$_POST['date'];
$classe=$_GET['idClass'];
//$email=$_POST['email'];
//$telephone=$_POST['telephone'];
//$specialite=$_POST['specialite'];
//$password=$_POST['password'];



if (empty($idCand) || empty($nom) || empty($prenom) || empty($classe)) {
    header("Location: ../PAGES/Ajouter.php?error=Veuillez compléter tous les champs&idCarteEtudiant=$idCand&nom=$nom&prenom=$prenom&idClass=$classe");
    exit();
}
else {
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req = "INSERT INTO eleve VALUES ($idCand, '$nom', '$prenom', '$classe')";
    $result=requeteSelect($cnx, $req);
/*
    for ($i=1; $i <=6 ; $i++) { 
        $req = "INSERT INTO resultat VALUES ($idCand, $i, 0)";
        $result=requeteSelect($cnx, $req);
    }*/
  
    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne ajoutée");
}

/*
$cnx= Connexion("localhost", "bddtech", "root", "");
$req = "UPDATE candidat SET nom='$nom', Prenoms='$prenom', Adresse='$adresse', courriel='$email', password='$password' WHERE idCand='$val'";
$result=requeteSelect($cnx, $req);*/

?>