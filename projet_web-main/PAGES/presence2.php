<?php

session_start();
include_once('../SCRIPTS/Modele.php');
require_once('../SCRIPTS/DotEnv.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

if (isset($_SESSION['idUser'])){
    $idUser = $_SESSION['idUser'];
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
            <?php if($idUser==0){?>
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
            <div class="dropdown">
                <button class="dropbtn">Menu cours
                <i class="arrow down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="Visu_tab_R.php">Emploi du temps</a>
                    <a href="ajoutSeance.php">Ajouter une séance</a>
                </div>
            </div>
            <?php
            }
            else{
                ?><a href="Visu_tab_IC.php">Informations</a><?php
                ?><a href="Visu_tab_R.php">Emploi du temps</a><?php
            }?>

            
            <a href="../PAGES/presence.php">Fiche de présence</a>
            <a href="../SCRIPTS/Logout.php">Déconnexion</a>
        </nav>
    </header>

    <section>
            <form action="absent.php" method="POST">
                <table class="tableau">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Présent(e)</th>
                            <th>Retard</th>
                        </tr>
                    </thead>
                    <tbody>

            <?php
            $req = "SELECT idCarteEtudiant, nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass=classe.idClass WHERE eleve.idClass = $classe";      
            $result=requeteSelect($cnx, $req);
            $result = $result -> fetchAll();

            echo $_GET['date']." ".$_GET['hour']."</br>";
            $delta = $_GET['hour'] + $_GET['duree'];
            $class = $_GET['idClass'];
            $checked = "SELECT idCarteEtudiant FROM eleve e INNER JOIN scan s ON e.idCarteEtudiant=s.uid WHERE s.time BETWEEN '".$_GET['date'] ." ".$_GET['hour'].":00:00' AND '".$_GET['date']." ".$delta.":00:00' AND e.idClass=$class";
            $late = "SELECT idCarteEtudiant FROM eleve e INNER JOIN scan s ON e.idCarteEtudiant=s.uid WHERE s.time BETWEEN '".$_GET['date'] ." ".$_GET['hour'].":15:00' AND '".$_GET['date']." ".$delta.":00:00' AND e.idClass=$class";
            $result_check = requeteSelect($cnx, $checked);
            $late_check = requeteSelect($cnx, $late);
            $result_check = $result_check -> fetchAll();
            $late_check = $late_check -> fetchAll(PDO::FETCH_ASSOC);
            echo "<br>";
            $presence = array($classe);
            foreach($result as $ligne){
            $label=$ligne['label'];
            ?>
                        <tr>
                            <td><?php echo $ligne['nom']; ?></td>
                            <td><?php echo $ligne['prenom'];?></td> 
                            <td><input type="checkbox" disabled
                            <?php
                            
                            foreach($result_check as $ligne_check){
                                if($ligne_check['idCarteEtudiant'] == $ligne['idCarteEtudiant']){
                                    echo "checked";
                                    array_push($presence, $ligne['idCarteEtudiant']);
                                    break;
                                }
                            }
                            
                            ?>
                            
                            ></td>
                            <td><input type="checkbox" disabled
                            <?php
                            foreach ($late_check as $ligne_late) {
                                if($ligne_late['idCarteEtudiant'] == $ligne['idCarteEtudiant']){
                                    echo "checked";
                                    array_push($presence, $ligne['idCarteEtudiant']);
                                    break;
                                }
                                
                            }
                            ?>
                            
                            ></td>
                        </tr>
            <?php
                }
            ?>

                </table>
                    </tbody>

                    <tr><center>
                        <td> <input type='submit' value='Envoyer'></td></form>
                        <td> <form action="../SCRIPTS/generatePdf.php" method="POST"><button type="submit">Générer PDF</button>
                        <input type="hidden" name="debut" value="<?php echo $_GET['date'] ." ".$_GET['hour'].":00:00" ?>">
                        <input type="hidden" name="fin" value="<?php echo $_GET['date'] ." ".$delta.":00:00" ?>">
                        <input type="hidden" name="classe" value="<?php echo $class ?>">
                        <input type="hidden" name="label" value=" <?php echo $label ?>">
                        </form></td>
                    </tr>


            
    
        
        
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