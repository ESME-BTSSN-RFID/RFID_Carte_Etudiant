<?php
require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv(__DIR__ . '../../../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

$classe=$_GET['idClass'];
$cours=$_GET['idCours'];
$prof=$_GET['idProf'];
$salle=$_GET['idSalle'];
$debut=$_GET['heureDebut'];
$duree=$_GET['duree'];
//$telephone=$_POST['telephone'];
//$specialite=$_POST['specialite'];
//$password=$_POST['password'];



if (empty($classe) || empty($cours) || empty($prof) || empty($salle) || empty($debut) || empty($duree)) {
    header("Location: ../PAGES/ajoutSeance.php?error=Veuillez compléter tous les champs&idClass=$idClass&idCours=$idCours&idProf=$idProf&idSalle=$salle&heureDebut=$debut&heureFin=$fin");
    exit();
}
else {

    $new_hour = intval(substr($debut, -5, 2)) + $duree;
    $fin = str_replace(substr($debut, -5, 2), $new_hour, $debut);

    $cnx=Connexion($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
    $req = "INSERT INTO seance VALUES (NULL, $classe, '$cours', '$prof', '$salle', '$debut', '$fin', '$duree')";
    $result=requeteSelect($cnx, $req);


/*
    for ($i=1; $i <=6 ; $i++) { 
        $req = "INSERT INTO resultat VALUES ($idCand, $i, 0)";
        $result=requeteSelect($cnx, $req);
    }*/
  
    header("Location: ../PAGES/Visu_tab_R.php?succes=Une ligne ajoutée");
}

/*
$cnx= Connexion("localhost", "bddtech", "root", "");
$req = "UPDATE candidat SET nom='$nom', Prenoms='$prenom', Adresse='$adresse', courriel='$email', password='$password' WHERE idCand='$val'";
$result=requeteSelect($cnx, $req);*/

?>