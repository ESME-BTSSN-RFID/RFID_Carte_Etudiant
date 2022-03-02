<?php
require_once('Modele.php');

$classe=$_GET['idClass'];
$cours=$_GET['idCours'];
$prof=$_GET['idProf'];
$debut=$_GET['heureDebut'];
$fin=$_GET['heureFin'];
//$telephone=$_POST['telephone'];
//$specialite=$_POST['specialite'];
//$password=$_POST['password'];



if (empty($classe) || empty($cours) || empty($prof) || empty($debut) || empty($fin)) {
    header("Location: ../PAGES/ajoutSeance.php?error=Veuillez compléter tous les champs&idClass=$idClass&idCours=$idCours&idProf=$idProf&heureDebut=$debut&heureFin=$fin");
    exit();
}
else {
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req = "INSERT INTO seance VALUES (NULL, $classe, '$cours', '$prof', '$debut', '$fin')";
    //echo $req;
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