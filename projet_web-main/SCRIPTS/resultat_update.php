<?php
session_start();
$idCand_resultat=$_SESSION['idCand_resultat'];

require_once('Modele.php');

$anglais=$_POST['Anglais'];
$cg=$_POST['Culture_Generale'];
$francais=$_POST['Francais'];
$info=$_POST['Informatique'];
$maths=$_POST['Mathematiques'];
$physique=$_POST['Physique'];

$tab = array($anglais => 3, $cg => 4, $francais => 2, $info => 1, $maths => 6, $physique => 5);

if (empty($anglais) || empty($cg) || empty($francais) || empty($info) || empty($maths) || empty($physique)) {
    header("Location: Resultat_Modifier.php?error=Veuillez compléter tous les champs&idCand=$idCand_resultat&Anglais=$anglais&Culture_Generale=$cg&Francais=$francais&Informatique=$info&Mathematiques=$maths&Physique=$physique");
    exit();
}
else{
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    
    foreach($tab as $key => $value){
        $req="UPDATE resultat SET note='$key' WHERE idCand='$idCand_resultat' AND idEpr='$value'";
        $result=requeteSelect($cnx, $req);
    }
    header("Location: Visu_tab_R.php?succes=Une ligne modifiée");
}



?>