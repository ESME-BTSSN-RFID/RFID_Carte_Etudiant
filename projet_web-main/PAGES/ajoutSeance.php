<?php
require_once("../SCRIPTS/Modele.php");
require_once('../SCRIPTS/DotEnv.php');

(new DotEnv('../.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

session_start();
$idCand = $_SESSION['idCand'];

$cnx = Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
$req = "SELECT idClass, label FROM classe";
$result=requeteSelect($cnx, $req);


#$date = date("H:m", strtotime("+56 minutes", strtotime("16:20")));
#echo $date;

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Ajouter une séance</title>
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

    <form action="../SCRIPTS/ajout.php" method="GET"> 
        <table class="mod">
            <tr>
                <th>Classe</th>
                <th>Matière</th>
                <th>Professeur</th>
                <th>Salle</th>
                <th>Heure du début</th>
                <th>Durée</th>
            </tr>

            <tr>
                <td>
                    <select name="idClass">
                    <option value="">--Sélectionner la classe--</option>
                        <?php foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idClass'] ?>"><?php echo utf8_encode($ligne['label'])?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idCours">
                    <option value="">--Sélectionner la matière--</option>
                        <?php   $req="SELECT idCours, matiere FROM cours";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idCours'] ?>"><?php echo utf8_encode($ligne['matiere'])?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idProf">
                    <option value="">--Sélectionner le prof--</option>
                        <?php   $req="SELECT idProf, nom, prenom FROM prof";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idProf'] ?>"><?php echo utf8_encode($ligne['nom'])?> <?php echo utf8_encode($ligne['prenom'])?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idSalle">
                    <option value="">--Sélectionner la salle--</option>
                        <?php   $req="SELECT idSalle, room FROM salle";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idSalle'] ?>"><?php echo utf8_encode($ligne['room'])?></option>
                    <?php }?>
                    </select>
                </td>
                <td><input type='datetime-local' name="heureDebut"></td>
                <td><input type='number' name="duree" min="1" max="10"></td>
        
                <td><input type='submit'></td>
            </tr>        
        </table>
    </form>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
</body>
</html>