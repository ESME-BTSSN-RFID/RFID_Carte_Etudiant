<?php
session_start();
$idCand_resultat=$_SESSION['idCand_resultat'];

require_once('Modele.php');

$seance=$_GET['idSeance'];
$classe=$_GET['idClass'];
$cours=$_GET['idCours'];
$prof=$_GET['idProf'];
$debut=$_GET['heureDebut'];
$fin=$_GET['heureFin'];

//$tab = array($anglais => 3, $cg => 4, $francais => 2, $info => 1, $maths => 6, $physique => 5);

if (empty($seance) || empty($classe) || empty($cours) || empty($prof) || empty($debut) || empty($fin)) {
    header("Location: Resultat_Modifier.php?error=Veuillez compléter tous les champs&idSeance=$seance&cours=$idCours&idProf=$prof&heureDebut=$debut&heureFin=$fin");
    exit();
}
else{
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    
    foreach($tab as $key => $value){
        $req="UPDATE seance SET idClass='$classe', idCours='$cours', idProf='$prof', heureDebut='$debut', heureFin='$fin' WHERE idSeance='$seance'";
        $result=requeteSelect($cnx, $req);
    }
    header("Location: Visu_tab_R.php?succes=Une ligne modifiée");
}



?>