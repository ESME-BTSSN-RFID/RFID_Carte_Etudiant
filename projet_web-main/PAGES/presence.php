<?php
session_start();
include_once('../SCRIPTS/Modele.php');
if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];
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
                    <a href="suppr_seance.php">Supprimer une séance</a>
                </div>
            </div>
            <a href="../PAGES/presence.php">Fiche de présence</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <section>

        <?php
            $cnx=Connexion("localhost", "projet_btssnir", "root", "");
            $req = "SELECT * FROM classe";
            $result=requeteSelect($cnx, $req);     
            
            if (isset($_GET['error'])){
                echo "<p class='error'>".$_GET['error']."</p>";
            }


            
            if(isset($_GET['classe']) || isset($_GET['week'])){
                $classe = $_GET['classe'];
                $week = substr($_GET['week'], -2);
                $year = substr($_GET['week'], 0, 4);

                $week_input = $year."-W".$week;
            }
            else{
                $classe = 1;
                $week = date("W");
                $year = date("Y");

                $week_input = $year."-W".$week;
            }


        ?>

        <form action="../SCRIPTS/edt2.php" action="GET">
            <select name="classe" >
                <option value="">--Choisir une classe--</option>
                <?php
                    foreach($result as $row){
                        ?>
                        <option value="<?php echo $row['idClass'];?>"><?php echo $row['label'];?></option>
                        <?php
                    }
                ?>
        
            </select>
            
            <input type="week" name="week" value="<?php echo $week_input ?>">
            <input type="submit" value="Choisir">
        
        </form>

        <table class="tableau">
            <tr>
                <th>Heure</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>

            <?php

            $dto = new DateTime();
            $first_of_week = $dto->setISODate($year, $week)->format('Y-m-d');
            $last_of_week = $dto->modify('+6 days')->format('Y-m-d');

            $month_array = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
            echo "<p>Semaine du ".substr($first_of_week, 8, 2)." ".$month_array[substr($first_of_week, 5, 2)-1]." au ".substr($last_of_week, 8, 2)." ".$month_array[substr($last_of_week, 5, 2)-1]."</p>";

            $req = "SELECT s.idSeance, p.nom, m.matiere, c.label, s.heureDebut, s.heureFin FROM seance s INNER JOIN prof p ON s.idProf=p.idProf INNER JOIN cours m ON s.idCours=m.idCours INNER JOIN classe c ON s.idClass=c.idClass WHERE heureDebut>='$first_of_week''T00:00' AND heureFin<='$last_of_week''T23:59' AND s.idClass = $classe ORDER BY heureDebut";
            $result=requeteSelect($cnx, $req);
            $result = $result -> fetchAll();

            
            $actual_date = date('Y-m-d', time());
            /*$timestamp = strtotime($actual_date);
            $day = date('D', $timestamp);
            echo $day."</br>";*/



            for($i=0 ;$i<=6; $i++) {
                $week_array[] = date('Y-m-d', strtotime("+ $i day", strtotime($first_of_week)));
            }
            
            /*
            foreach($result as $line){
                print_r( "</br>".$line["dateDebut"]);
                echo "     ". substr($line["dateDebut"], 0, 10);
                echo "     ". substr($line["dateDebut"], 11);
            }*/

            for($i=8; $i<=18; $i++){
                echo "<tr>";
                for($j=0; $j<=7; $j++){
                    echo "<td>";
                    if($j == 0){
                        if(strlen($i) == 1){
                            $hour = "0".$i;
                            echo $hour."h00";
                        }
                        else{
                            $hour = $i;
                            echo $hour."h00";
                        }
                    }
                    else{
                        //With $hour and date in $week_array compare in database
                        foreach($result as $x=>$line){
                            $string_date = substr($line["heureDebut"], 0, 10);
                            $string_hour = substr($line["heureDebut"], 11, 2);
                                                        
                            if ($string_date == $week_array[$j-1]  && $string_hour == $hour) {
                                echo substr($line[4], 11)." - ".substr($line[5], 11)."</br>";
                                echo utf8_encode($line[2])."</br>";
                                echo utf8_encode($line[1]);?>

                                <form action='../PAGES/presence2.php' method='GET'>
                                    </br><button name='idSeance' value='<?php echo $line[0]?>'>Présence</button>
                                </form>

                                <?php
                                //remove the line from the array
                                unset($result[$x]);
                            }
                        }
                        
                    }

                    echo "</td>";
                }
                echo "</tr>";
            }

            ?>
        
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