<?php

session_start();
include_once('../SCRIPTS/Modele.php');
require_once('../SCRIPTS/DotEnv.php');

(new DotEnv('../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];
    $classe = isset($_GET['idClass']) ? $_GET['idClass'] : 2;
    //$classe=$_GETT['idClass'];

    $cnx = Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Fiche de présence</title>
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
  
            <div class="dropdown">
                <button class="dropbtn">Menu cours
                <i class="arrow down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="Visu_tab_R.php">Emploi du temps</a>
                    <a href="ajoutSeance.php">Ajouter une séance</a>
                </div>
            </div>
            <a href="../PAGES/presence.php">Fiche de présence</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <section>
            <form action="absent.php" method="POST">
                <table class="tableau">
                    <thead>
                        <tr>
                            <th>Carte Etudiant</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Absent(e)</th>
                        </tr>
                    </thead>
                    <tbody>

            <?php
            $req = "SELECT idCarteEtudiant, nom, prenom, idClass FROM eleve WHERE idClass = $classe";      
            $result=requeteSelect($cnx, $req);
            $result = $result -> fetchAll();
            foreach($result as $ligne){
            ?>
                        <tr>
                            <td><?php echo $ligne['idCarteEtudiant']; ?></td>
                            <td><?php echo $ligne['nom']; ?></td>
                            <td><?php echo $ligne['prenom'];?></td> 
                            <td><input type="checkbox" name="statut[]" value=""<?php echo $ligne['idCarteEtudiant']; ?>></td>
                        </tr>
            <?php
                }
            ?>
                </table>
                    </tbody>
                    <td><center><input type='submit' value='Envoyer'></td>
            <form>

        
        
    </section>
</body>
</html>
<?php
}else{
    header("Location: ../PAGES/index.php");
    echo "test 3";
    exit();
}
?>