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

        if(isset($_GET['idClass']) && isset($_GET['idCours']) && isset($_GET['idProf']) && isset($_GET['idSalle']) && isset($_GET['heureDebut']) && isset($_GET['duree'])){
            $classe=$_GET['idClass'];
            $cours=$_GET['idCours'];
            $prof=$_GET['idProf'];
            $salle=$_GET['idSalle'];
            $debut=$_GET['heureDebut'];
            $duree=$_GET['duree'];
        }
        else{
            header('Location: ../PAGES/Visu_tab_IC.php');
        }

        if (empty($classe) || empty($cours) || empty($prof) || empty($salle) || empty($debut) || empty($duree)) {
            header("Location: ../PAGES/ajoutSeance.php?error=Veuillez compléter tous les champs&idClass=$idClass&idCours=$idCours&idProf=$idProf&idSalle=$salle&heureDebut=$debut&heureFin=$fin");
            exit();
        }
        else {

            $new_hour = intval(substr($debut, -5, 2)) + $duree;
            $fin = str_replace(substr($debut, -5, 2), $new_hour, $debut);

            $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
            $req = "INSERT INTO seance VALUES (NULL, $classe, '$cours', '$prof', '$salle', '$debut', '$fin', '$duree')";
            $result=requeteSelect($cnx, $req);

            header("Location: ../PAGES/ajoutSeance.php?error=Séance ajoutée");
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