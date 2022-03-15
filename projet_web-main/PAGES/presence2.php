<?php
session_start();
include_once('../SCRIPTS/Modele.php');
if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];

    $seance=$_GET['idSeance'];
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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
            <a href="../PAGES/presence.php">Fiche de présence</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <section>


            <?php
            $i = 0;
            $sql2 = "SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf WHERE idSeance = $seance;";
            $msg = $bdd->prepare($sql2);
            $msg = $bdd->execute(array($_POST['classe']));               
            ?>
            <form method="post" action="surveillant.prendre_absence3.php">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom(s)</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Absent(e)</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            while($dd = $msg->fetch() )
                {
            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $dd['nom']; ?></td>
                            <td><?php echo $dd['prenom'];?></td>         
                            <td><?php echo $dd['ddn']; ?></td>
                            <td><?php echo $dd['lieu']; ?></td>
                            <td><input type="checkbox" name="statut[]" value=""<?php echo $dd['id']; ?>></td>
                        </tr>
            <?php
                $i++;
                }
            ?>
                    </tbody>
                </table>
                <input type='submit' value='Envoyer !' >
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