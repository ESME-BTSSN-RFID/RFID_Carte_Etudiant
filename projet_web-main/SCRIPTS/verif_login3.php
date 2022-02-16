<?php
session_start();
require_once('Modele.php');


if((isset($_POST['login'])) && (isset($_POST['password']))){    
    
    $login=$_POST['login'];
    $password=$_POST['password'];
    

    if(empty($login)){
        header("Location: ../PAGES/index.php?error=L'adresse mail est requise");
        exit();
    }
    elseif(empty($password)){
        header("Location: ../PAGES/index.php?error=Le mot de passe est requis");
        exit();
    }
    else {
        $cnx=Connexion("localhost", "projet_btssnir", "root", "");
        $req = "SELECT * FROM utilisateur";
        $result=requeteSelect($cnx, $req);
        print_r($result);
        
        
        foreach($result as $ligne){
                if($ligne['login']==$login && $ligne['password']==$password){
                    $_SESSION['idCand'] = $ligne[0];
                    $_SESSION['nom']=$ligne[1];
                    $_SESSION['nom']=$ligne[2];
                    header("Location: ../PAGES/Visu_tab_IC.php");
                    exit();
                }   
        }
        
        header("Location: ../PAGES/index.php?error=Email ou mot de passe incorrect");
        exit();
    }

}
else{
    header("Location: ../PAGES/index.php?error");
    exit;
}


?>