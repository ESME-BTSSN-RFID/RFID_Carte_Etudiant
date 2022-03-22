<?php
require_once('Modele.php');

$idCand=$_POST['idCarteEtudiant'];

if(!empty($idCand)){
    $cnx= Connexion("localhost", "projet_btssnir", "root", "");
    
    $req = "DELETE FROM eleve WHERE idCarteEtudiant= '$idCand'";
    $result=requeteSelect($cnx, $req);
    
    header("Location: ../PAGES/Supprimer.php?succes=Donnée de l'étudiant supprimée avec succès");
}
else {
    header("Location: ../PAGES/Supprimer.php?error=Veuillez sélectionner un étudiant");
}


?>