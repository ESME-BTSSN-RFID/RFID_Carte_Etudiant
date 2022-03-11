<?php
require_once('Modele.php');

$seance=$_POST['idSeance'];

if(!empty($seance)){
    $cnx= Connexion("localhost", "projet_btssnir", "root", "");
    
    $req = "DELETE FROM seance WHERE idSeance= '$seance'";
    $result=requeteSelect($cnx, $req);
    
    header("Location: ../PAGES/Visu_tab_R.php?succes=Séance supprimée avec succès");
}
else {
    header("Location: ../PAGES/suppr_seance.php?error=Veuillez sélectionner une séance");
}

?>