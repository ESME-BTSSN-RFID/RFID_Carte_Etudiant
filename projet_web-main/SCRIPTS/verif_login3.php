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

        $stmt = $cnx->prepare("SELECT password, idProf FROM `utilisateur` WHERE login= ?;");
        $stmt->execute(array($login));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();

        if($rowCount==1){
            if(password_verify($password, $result['password'])){
                $_SESSION['idUser'] = $result['idProf'];
                header("Location: ../PAGES/Visu_tab_IC.php");
                exit();
            }
            else{
                header("Location: ../index.php?error=Mot de passe incorrect");
                exit();
            }
        }
        else {
            header("Location: ../index.php?error=Le login n'existe pas");
            exit();
        }

    }

}
else{
    header("Location: ../index.php?error");
    exit;
}
?>