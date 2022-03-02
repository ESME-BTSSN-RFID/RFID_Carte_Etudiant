<?php
session_start();
$idCand = $_SESSION['idCand'];
require_once('../SCRIPTS/Modele.php');

$cnx = Connexion("localhost", "projet_btssnir", "root", "");

    $req="SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf;";
    $result=requeteSelect($cnx, $req);


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

    <form action="../SCRIPTS/resultat_update.php" method="GET"> 
        <table class="mod">
            <tr>
                <th>Cours</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Professeur</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
            </tr>
            <tr>
                <td>
                    <select name="idSeance">
                        <option value="">--Sélectionner le cours--</option>
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
                    <select name="idClass">
                    <option value="">--Modifier la classe--</option>
                        <?php   $req="SELECT idClass, label FROM classe";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idClass'] ?>"><?php echo $ligne['label']?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idCours">
                    <option value="">--Modifier la matière--</option>
                        <?php   $req="SELECT idCours, matiere FROM cours";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idCours'] ?>"><?php echo $ligne['matiere']?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idProf">
                    <option value="">--Modifier le prof--</option>
                        <?php   $req="SELECT idProf, nom, prenom FROM prof";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idProf'] ?>"><?php echo $ligne['nom']?> <?php echo $ligne['prenom']?></option>
                    <?php }?>
                    </select>
                </td>
                <td><input type='datetime-local' name="heureDebut"></td>
                <td><input type='datetime-local' name="heureFin"></td>
        
                <td><input type='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>