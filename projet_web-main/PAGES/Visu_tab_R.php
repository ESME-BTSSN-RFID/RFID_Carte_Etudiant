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
    <title>Emploi du temps</title>
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
                    <a href="Resultat_Modifier.php">Modifier les séances</a>
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <section>
            <?php
                $cnx=Connexion("localhost", "projet_btssnir", "root", "");
                $req="SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf;";
                $result=requeteSelect($cnx, $req);?>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <?php
                            foreach($result as $ligne){
                            $date = substr($ligne['heureDebut'], 0, 10);
                            $timestamp = strtotime($date);
                            $day = date('l', $timestamp);
                            var_dump($day);
                            $debut = substr($ligne['heureDebut'], 11);
                            $fin = substr($ligne['heureFin'], 11);
                            $tab = array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');
                        }
                    
                            $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                            $rdv["Dimanche"]["16"] = "Maths";
                            $rdv["Lundi"]["8"] = "Anglais";
                            echo "<tr><th>Heure</th>";
                            for($x = 1; $x < 8; $x++)
                                echo "<th>".$jour[$x]."</th>";
                            echo "</tr>";
                            for($j = 8; $j < 19; $j += 2) {
                                echo "<tr>";
                                for($i = 0; $i < 7; $i++) {
                                    if($i == 0) {
                                        $heure = str_replace(".2", ":00", $j);
                                        echo "<td class=\"time\">".$heure."</td>";
                                    }
                                    echo "<td>";
                                    if(isset($rdv[$jour[$i+1]][$heure])) {
                                        echo $rdv[$jour[$i+1]][$heure];
                                    }
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                </tr>
                    </table>
                                
                    <?php $candidat=requeteSelect($cnx, $req);

                            
                    if (isset($_GET['succes'])){ ?>
                            <?php echo "test 1"; ?>
                            <p class="succes"><?php echo $_GET['succes']; ?></p>
                            <?php echo "test 2"; ?>
                            <?php } ?>
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