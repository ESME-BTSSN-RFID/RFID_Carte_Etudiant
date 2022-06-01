<?php
session_start();

if(isset($_SESSION['idUser'])){
    if($_SESSION['idUser'] == 0){
        require_once('Modele.php');
        require_once('DotEnv.php');

        (new DotEnv('/home/.env'))->load();
        $DB_HOST = getenv('DB_HOST');
        $DB_NAME = getenv('DB_NAME');
        $DB_USER = getenv('DB_USER');
        $DB_PASS = getenv('DB_PASS');

        $idCarteEtudiant=$_GET['idCarteEtudiant'];
        $nom=$_GET['nom'];
        $prenom=$_GET['prenom'];
        $idClass=$_GET['idClass'];

        if (empty($idCarteEtudiant) || empty($nom) || empty($prenom) || empty($idClass)) {
            header("Location: ../PAGES/Modifier.php?error=Veuillez compléter tous les champs&val=$val&idCarteEtudiant=$idCarteEtudiant&nom=$nom&prenom=$prenom&idClass=$idClass");
            exit();
        }
        else{
            $cnx= Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
            $req = "UPDATE eleve SET nom='$nom', prenom='$prenom', idClass=$idClass WHERE idCarteEtudiant='$idCarteEtudiant'";
            $result=requeteSelect($cnx, $req);

            header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne modifiée");
            
        }
    }
    
    else{
        header("Location: ../PAGES/Modifier.php");
    }
}
else{
    header("Location: ../index.php");
}
?>