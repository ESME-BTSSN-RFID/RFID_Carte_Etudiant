<?php

function Connexion($host, $dbname, $user, $passwd){
	
	try{
		$connect = new PDO("mysql:host=".$host.";dbname=".$dbname,$user,$passwd);
		$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $event){
    		echo "Erreur : ".$event -> getMessage()."<br/>";
    		die();
	}

	return $connect;
}

function requeteSelect($cnx, $req){
	try{
		//Création du Statement
		$stmt = $cnx->query($req);
	}
	catch(PDOException $e){
		die('Erreur : '.$e->getMessage());
	}
	return $stmt;

}

?>