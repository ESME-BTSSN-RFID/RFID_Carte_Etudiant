<?php
require_once('Modele.php');

$idCand=$_POST['idCand'];

if(!empty($idCand)){
    $cnx= Connexion("localhost", "projet_btssnir", "root", "");
    
    $req="DELETE FROM resultat WHERE idCand=$idCand";
    $result=requeteSelect($cnx, $req);
    $req = "DELETE FROM candidat WHERE idCand= '$idCand'";
    $result=requeteSelect($cnx, $req);
    
    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne supprimée");
}
else {
    header("Location: ../PAGES/Supprimer.php?error=Veuillez sélectionner un candidat");
}


?>