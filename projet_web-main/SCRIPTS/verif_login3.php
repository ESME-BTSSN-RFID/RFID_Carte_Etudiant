<?php
session_start();
require_once('Modele.php');
require_once('DotEnv.php');

(new DotEnv('../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

if((isset($_POST['login'])) && (isset($_POST['password']))){    
    
    $login=$_POST['login'];
    $password=$_POST['password'];
    

    if(empty($login)){
        header("Location: ../index.php?error=L'adresse mail est requise");
        exit();
    }
    elseif(empty($password)){
        header("Location: ../index.php?error=Le mot de passe est requis");
        exit();
    }
    else {
        $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
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
        
        header("Location: ../index.php?error=Email ou mot de passe incorrect");
        exit();
    }

}
else{
    header("Location: ../index.php?error");
    exit;
}


?>