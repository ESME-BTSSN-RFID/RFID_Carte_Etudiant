<?php

	try{
			$pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO ('mysql:host=192.168.50.1, dbname=projet_btssnir', 'root', $pdo_options);

			$sql = 'SELECT nom, prenom, presence FROM eleve;';
			$response = $bdd->query($sql);
			$result = $response->fetchAll(PDO::FETCH_ASSOC);
	}
	
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	echo(json_encode($result));

?>