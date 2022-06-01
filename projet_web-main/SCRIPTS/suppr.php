<?php
require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

session_start();
if(isset($_SESSION['idUser'])){
    if($_SESSION['idUser'] == 0){

        $idUser = $_SESSION['idUser'];

        if(isset($_POST['idSeance'])){
            $seance=$_POST['idSeance'];
        }
        
        if(!empty($seance)){
            $cnx= Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
            
            $req = "DELETE FROM seance WHERE idSeance= '$seance'";
            $result=requeteSelect($cnx, $req);
            
            header("Location: ../PAGES/Visu_tab_R.php?succes=Séance supprimée avec succès");
        }
        else {
            header("Location: ../PAGES/suppr_seance.php?error=Veuillez sélectionner une séance");
        }
    }
    
    else{
        header("Location: ../PAGES/Visu_tab_IC.php");
    }
}
else{
    header("Location: ../index.php");
}
        ?>