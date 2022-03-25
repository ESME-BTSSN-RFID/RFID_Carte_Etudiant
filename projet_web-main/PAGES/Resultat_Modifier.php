<?php
session_start();
$idCand = $_SESSION['idCand'];
require_once('../SCRIPTS/Modele.php');
require_once('../SCRIPTS/DotEnv.php');

(new DotEnv(__DIR__ . '../../../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

$seance=$_GET['idSeance'];

$cnx = Connexion($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);

/*$req="SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf;";
$result=requeteSelect($cnx, $req);*/
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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
            <a href="../PAGES/presence.php">Fiche de présence</a>
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
                <th>Salle</th>
                <th>Heure de début</th>
                <th>Durée</th>
            </tr>
            <tr>
                <td><?php $req="SELECT idSeance, c.label, m.matiere, p.nom, p.prenom, heureDebut, heureFin FROM seance AS s INNER JOIN classe AS c ON s.idClass = c.idClass INNER JOIN cours AS m ON s.idCours = m.idCours INNER JOIN prof AS p ON s.idProf = p.idProf WHERE idSeance = $seance;";
                            $result=requeteSelect($cnx, $req);
                            foreach($result as $ligne){
                                $date = substr($ligne['heureDebut'], 0, 10);
                                $timestamp = strtotime($date);
                                $day = date('l', $timestamp);
                                $debut = substr($ligne['heureDebut'], 11);
                                $fin = substr($ligne['heureFin'], 11);
                                $tab = array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');?>

                    <label value="<?php echo $ligne['idSeance'] ?>" ><?php echo $ligne['label']." ".utf8_encode($ligne['matiere'])." ".$ligne['nom']." ".$tab[$day]." - ".$debut." à ".$fin?></label>
                    <?php $_SESSION['idSeance']=$ligne['idSeance'];}?>   
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
                    <option value="<?php echo $ligne['idCours'] ?>"><?php echo utf8_encode($ligne['matiere'])?></option>
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
                <td>
                    <select name="idSalle">
                    <option value="">--Modifier la salle--</option>
                        <?php   $req="SELECT idSalle, room FROM salle";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idSalle'] ?>"><?php echo $ligne['room']?></option>
                    <?php }?>
                    </select>
                </td>
                <td><input type='datetime-local' name="heureDebut"></td>
                <td><input type='number' name="duree" min="1" max="10"></td>        
                <td><input type='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>