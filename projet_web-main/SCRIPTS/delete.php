<?php
session_start();
if(isset($_SESSION['idUser'])){
    if($_SESSION['idUser'] == 0){
        require_once('Modele.php');
        require_once('DotEnv.php');

        (new DotEnv('../.env'))->load();
        $DB_HOST = getenv('DB_HOST');
        $DB_NAME = getenv('DB_NAME');
        $DB_USER = getenv('DB_USER');
        $DB_PASS = getenv('DB_PASS');
        
        if(isset($_POST['idCarteEtudiant'])){
            $idCand=$_POST['idCarteEtudiant'];
        }

        if(!empty($idCand)){
            $cnx= Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
            
            $req = "DELETE FROM eleve WHERE idCarteEtudiant= '$idCand'";
            $result=requeteSelect($cnx, $req);
            
            header("Location: ../PAGES/Supprimer.php?succes=Donnée de l'étudiant supprimée avec succès");
        }
        else {
            header("Location: ../PAGES/Supprimer.php?error=Veuillez sélectionner un étudiant");
        }
    }
    else{
        header('Location: ../PAGES/Supprimer.php');
    }
}
else {
    header('Location: ../index.php');
}
?>