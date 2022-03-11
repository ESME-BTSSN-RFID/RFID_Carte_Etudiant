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
            $req = "SELECT * FROM classe";
            $result=requeteSelect($cnx, $req);

            $first_of_week = date("Y-m-d", strtotime('monday this week'));
            $last_of_week = date("Y-m-d", strtotime('sunday this week'));
            $first_month = date("m", strtotime('monday this week'));
            $last_month = date("m", strtotime('sunday this week'));
            
            $month = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
            $first_month = $month[intval($first_month)-1];
            $last_month = $month[intval($last_month)-1];

            $first_date = date("j ", strtotime($first_of_week));
            $last_date = date("j ", strtotime($last_of_week));

        
        ?>

        <form action="">
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
        
        <p><button class="button"> <i class="arrow left"></i></button> Semaine du <?php echo $first_date.$first_month?> au <?php echo $last_date.$last_month?> <button class="button"> <i class="arrow right"></i></button></p>
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
                        
            $cnx=Connexion("localhost", "projet_btssnir", "root", "");
            $req = "SELECT s.idSeance, p.nom, m.matiere, c.label, s.heureDebut, s.heureFin FROM seance s INNER JOIN prof p ON s.idProf=p.idProf INNER JOIN cours m ON s.idCours=m.idCours INNER JOIN classe c ON s.idClass=c.idClass WHERE heureDebut>='$first_of_week''T00:00' AND heureFin<='$last_of_week''T23:59' ORDER BY heureDebut";
            $result=requeteSelect($cnx, $req);
            $result = $result -> fetchAll();

            
            $actual_date = date('Y-m-d', time());
            echo $actual_date."<br>";
            /*$timestamp = strtotime($actual_date);
            $day = date('D', $timestamp);
            echo $day."</br>";*/



            for($i=0 ;$i<=6; $i++) {
                $week_array[] = date('Y-m-d', strtotime("+ $i day", strtotime($first_of_week)));
            }
            
            print_r($week_array);
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
                                echo "<form action='../SCRIPTS/suppr.php' method='POST'>";
                                echo substr($line[4], 11)." - ".substr($line[5], 11)."</br>";
                                echo utf8_encode($line[2])."</br>";
                                echo $line[1];
                                echo "</br><button name='idSeance' value='$line[0]'>Supprimer</button>";

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