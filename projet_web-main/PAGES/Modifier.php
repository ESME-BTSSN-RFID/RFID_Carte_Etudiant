<?php
session_start();
$idCand = $_SESSION['idCand'];

require_once('../SCRIPTS/Modele.php');

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Modifier information étudiant</title>
    <link rel="stylesheet" href="../CSS/style_visu3.css">
    <link rel="icon" href="../favicon.png ">
</head>
<body>
    <header>
        <nav>
            <?php if($idCand==0){?>
            <div class="dropdown">
                <button class="dropbtn">Menu étudiant
                <i class="arrow down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="Visu_tab_IC.php">Liste des étudiants</a>
                    <a href="Ajouter.php">Ajouter un étudiant</a>
                    <a href="Modifier.php">Modifier les informations d'un étudiant</a>
                    <a href="Supprimer.php">Supprimer un étudiant</a>
                </div>
            </div> 
            <?php
            }
            else{
                ?><a href="Visu_tab_IC.php">Informations</a><?php
            }?>
  
            <a href="Visu_tab_R.php">Résultat</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

<?php
$form=<<<HTML
<form action="../SCRIPTS/update.php" method="POST"> 
		<table class="mod">
			<tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Adresse mail</th>
                <th>Téléphone</th>
                <th>Spécialité</th>
                <th>Mot de passe</th>
			</tr>

			<tr>
HTML;		

$val=$_GET['val'];
$_SESSION['val']=$val;
if (isset($_GET['val'])){
	$cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req = "SELECT nom, Prenoms, DateNaissance, Adresse, courriel, Telephone, password FROM candidat WHERE idCand='$val'";
    $result=requeteSelect($cnx, $req);

	echo $form;
	
	foreach($result as $ligne){
		echo "<td><input type='text' name='nom' value='$ligne[0]'></td><td><input type='text' name='prenom' value='$ligne[1]'></td><td><input type='date' name='date' value='$ligne[2]'></td><td><input type='text' name='adresse' value='$ligne[3]'></td><td><input type='text' name='email' value='$ligne[4]'></td><td><input type='number' name='telephone' value='0$ligne[5]'></td>"."<td>
        <select name='specialite'>
            <option value=''>--Choisir une spécialité--</option>
            <option value='100'>DEV APP</option>
            <option value='200'>ING RESEAUX</option>
            <option value='300'>INTEG BDD</option>
            <option value='400'>ADM SYS</option>
            <option value='500'>Chef de projets</option>
        </select>
    </td>"."<td>"."<input type='text' name='password' value='$ligne[6]'>"."</td>";
    }

    echo "</tr>";
    echo "<tr><td><input type='submit'></td></tr></table></form>";
}
if (isset($_GET['error'])) {
    echo "<p class='error'>".$_GET['error']."</p>";
}

echo "</body></html>";

?>