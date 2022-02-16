<?php
session_start();
$val=$_SESSION['val'];

require_once('Modele.php');

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$adresse=$_POST['adresse'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$specialite=$_POST['specialite'];
$password=$_POST['password'];

if (empty($nom) || empty($prenom) || empty($date) || empty($adresse) || empty($email) || empty($telephone) || empty($specialite) || empty($password)) {
    header("Location: ../PAGES/Modifier.php?error=Veuillez compléter tous les champs&val=$val&nom=$nom&prenom=$prenom&date=$date&adresse=$adresse&email=$email&telephone=$telephone&specialite=$specialite");
    exit();
}
else{
    $cnx= Connexion("localhost", "projet_btssnir", "root", "");
    $req = "UPDATE candidat SET nom='$nom', Prenoms='$prenom', DateNaissance='$date', Adresse='$adresse', courriel='$email', Telephone=$telephone, idSpec=$specialite, password='$password' WHERE idCand='$val'";
    $result=requeteSelect($cnx, $req);

    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne modifiée");
    
}



?>