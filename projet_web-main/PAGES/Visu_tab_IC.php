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
    $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
    
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Liste</title>
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
    <?php if (isset($_GET['succes'])){ ?>
     		<p class="succes"><?php echo $_GET['succes']; ?></p>
     	    <?php } ?>


            <?php
                $cnx=Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
                $req = "SELECT * FROM classe";
                $result=requeteSelect($cnx, $req);     
                
                if (isset($_GET['error'])){
                    echo "<p class='error'>".$_GET['error']."</p>";
                }
                
                if(isset($_GET['classe'])){
                    $classe = $_GET['classe'];
                }

            ?>

    <table style="margin: auto;">
        <tr>
            <td>
                <form action="../SCRIPTS/liste_classe.php" action="GET" id="form">
                    <select name="classe">
                        <?php
                            foreach($result as $row){
                        ?>
                            <option value="<?php echo $row['idClass'];?>"<?php if(isset($_GET['classe'])){if(strcmp($_GET['classe'],$row['idClass']) == 0){ echo "selected";}}?>><?php echo $row['label'];?></option>
                        <?php
                        }?>
                    </select>

                    <script type="text/javascript">
                        var form = document.querySelector('form');
                        form.addEventListener('change', function() {
                        form.submit();
                        });
                    </script>

                </form>

                    <?php
                    if(isset($_GET['classe'])){
                        $classe = $_GET['classe']; 
                    }
                    else{
                        $classe=1;
                    }
                    
                    $req = "SELECT idCarteEtudiant, eleve.nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass = classe.idClass WHERE classe.idClass = $classe";
                    $result=requeteSelect($cnx, $req);?>
            </td>
        </tr>
    </table>
        
         <table class="tableau">
            <tr>
                <th>Carte Etudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
            </tr>

            <?php
            foreach($result as $ligne){
                echo "<tr>"."<td>".$ligne['idCarteEtudiant']."</td>"."<td>".$ligne['nom']."</td>"."<td>".$ligne['prenom']."</td>"."<td>".$ligne['label']."</td>";
                echo "\n";
            }
            ?>
    
        </table>       
    </section>
</body>
</html>

<?php
}else{
    header("Location: ../PAGES/index.php");
    exit();
}

?>