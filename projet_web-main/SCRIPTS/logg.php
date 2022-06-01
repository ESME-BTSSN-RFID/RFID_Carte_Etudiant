<?php
// if text data was posted

require_once("Modele.php");
require_once('DotEnv.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');


$log = $_POST["login"];
$password = $_POST["password"];

$cnx = Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
#$req = "INSERT INTO `utilisateur` (`login`, `password`) VALUES ($log, $password)";
//$req="SELECT COUNT(*) FROM utilisateur WHERE login='$log' AND password='$password'";
//$result=requeteSelect($cnx, $req);

$stmt = $cnx->prepare("SELECT password, idProf FROM `utilisateur` WHERE login= ?;");
$stmt->execute(array($log));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$rowCount = $stmt->rowCount();

if($rowCount==1){
    if(password_verify($password, $result['password'])){
        echo "1";
    }
    else{
        echo "0";
    }
}
else {
    echo "0";
}

?>