<?php
    require_once('../SCRIPTS/Modele.php');
    session_start();
    $idCand = $_SESSION['idCand'];

    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req="SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf;";
    $result=requeteSelect($cnx, $req);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Supprimer un étudiant</title>
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

    <form action="../SCRIPTS/suppr.php" method="POST">
        <table class="mod">
            <tr>
                <td>
                    <select name="idSeance">
                        <option value="">--Choisir une séance--</option>
                        <?php 
                        foreach($result as $ligne){
                                $date = substr($ligne['heureDebut'], 0, 10);
                                $timestamp = strtotime($date);
                                $day = date('l', $timestamp);
                                var_dump($day);
                                $debut = substr($ligne['heureDebut'], 11);
                                $fin = substr($ligne['heureFin'], 11);
                                $tab = array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');?>
                        <option value="<?php echo $ligne['idSeance'] ?>"><?php echo $ligne['label']." ".$ligne['matiere']." ".$ligne['nom']." ".$tab[$day]." - ".$debut." à ".$fin?></option>
                            <?php }?>
                    </select>
                </td>

                <td>
                    <input type="submit" value="supprimer">
                </td>
            </tr>
        </table>
    </form>
    <?php if(isset($_GET['error'])){?><p><?php echo $_GET['error'];?></p><?php }?>
</body>
</html>