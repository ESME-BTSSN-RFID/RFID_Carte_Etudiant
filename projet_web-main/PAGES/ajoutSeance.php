<?php
require_once("C:\wamp64\www\projet_web-main\projet_web-main\SCRIPTS\Modele.php");
session_start();
$idCand = $_SESSION['idCand'];

$cnx = Connexion("localhost", "projet_btssnir", "root", "");
$req = "SELECT idClass, label FROM classe";
$result=requeteSelect($cnx, $req);

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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
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
                <th>Heure de fin</th>
            </tr>

            <tr>
                <td>
                    <select name="idClass">
                    <option value="">--Sélectionner la classe--</option>
                        <?php foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idClass'] ?>"><?php echo $ligne['label']?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idCours">
                    <option value="">--Sélectionner la matière--</option>
                        <?php   $req="SELECT idCours, matiere FROM cours";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idCours'] ?>"><?php echo $ligne['matiere']?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idProf">
                    <option value="">--Sélectionner le prof--</option>
                        <?php   $req="SELECT idProf, nom, prenom FROM prof";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idProf'] ?>"><?php echo $ligne['nom']?> <?php echo $ligne['prenom']?></option>
                    <?php }?>
                    </select>
                </td>
                <td>
                    <select name="idSalle">
                    <option value="">--Sélectionner la salle--</option>
                        <?php   $req="SELECT idSalle, room FROM salle";
                                $result=requeteSelect($cnx, $req);
                        foreach($result as $ligne){?>
                    <option value="<?php echo $ligne['idSalle'] ?>"><?php echo $ligne['room']?></option>
                    <?php }?>
                    </select>
                </td>
                <td><input type='datetime-local' name="heureDebut"></td>
                <td><input type='datetime-local' name="heureFin"></td>
        
                <td><input type='submit'></td>
            </tr>        
        </table>
    </form>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
</body>
</html>