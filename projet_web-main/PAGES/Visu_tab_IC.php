<?php
session_start();
include_once('../SCRIPTS/Modele.php');
if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];
    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    if($idCand==0){
        $req="SELECT idCarteEtudiant, eleve.nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass = classe.idClass;";
        $result=requeteSelect($cnx, $req);
    }
    else{
        $req = "SELECT idCarteEtudiant, eleve.nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass = classe.idClass;"; 
        $result=requeteSelect($cnx, $req);
    }
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Liste</title>
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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>

            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>
    <section>
    <?php if (isset($_GET['succes'])){ ?>
     		<p class="succes"><?php echo $_GET['succes']; ?></p>
     	    <?php } ?>
             
        <table class="tableau">
            <tr>
                <th>Carte Etudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
            </tr>

            <?php
            foreach($result as $ligne){
                echo "<tr>"."<td>".$ligne['idCarteEtudiant']."</td>"."<td>".$ligne['nom']."</td>"."<td>".$ligne['prenom']."</td>"."<td>".$ligne['label']."</td>";
                echo "\n";
            }
            ?>
    
        </table>       
    </section>
</body>
</html>

<?php
}else{
    header("Location: ../PAGES/index.php");
    exit();
}

?>