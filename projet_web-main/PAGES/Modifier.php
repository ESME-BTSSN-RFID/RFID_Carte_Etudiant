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

$cnx = Connexion($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);

    $req="SELECT idCarteEtudiant, eleve.nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass = classe.idClass;";
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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
            <a href="../PAGES/presence.php">Fiche de présence</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <form action="../SCRIPTS/update.php" method="GET"> 
        <table class="mod">
            <tr>
                <th>Etudiant</th>
                <th>Nouveau nom</th>
                <th>Nouveau prénom</th>
                <th>Classe</th>
                <th>Valider</th>
            </tr>
            <tr>
                <td>
                    <select name="idCarteEtudiant">
                        <option value="">--Choisir un étudiant--</option>
                            <?php foreach($result as $ligne){?>
                        <option value="<?php echo $ligne['idCarteEtudiant'] ?>"><?php echo $ligne['nom']." ".$ligne['prenom']." -- ".$ligne['label'] ?></option>
                            <?php }?>
                    </select>
                </td>
                    
                <td><input type="text" name="nom" value="<?php if(isset($_GET['nom'])){echo$_GET['nom'];}?>"></td>
                <td><input type="text" name="prenom" value="<?php if(isset($_GET['prenom'])){echo$_GET['prenom'];}?>"></td>

                <td>   
                    <select name="idClass">
                        <option value="">--Choisir une classe--</option>
                            <?php 
                            $req="SELECT idClass, label FROM classe";
                            $result=requeteSelect($cnx, $req);
                            foreach($result as $ligne){?>
                        <option value="<?php echo $ligne['idClass']?>"><?php echo $ligne['label']?></option>
                            <?php }?>
                    </select>
                </td>
            
                <td><input type='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>