<?php
    require_once('../SCRIPTS/Modele.php');
    session_start();
    $idCand = $_SESSION['idCand'];

    $cnx=Connexion("localhost", "projet_btssnir", "root", "");
    $req="SELECT idCarteEtudiant, nom, prenom, classe.label FROM eleve INNER JOIN classe ON eleve.idClass=classe.idClass";
    $result=requeteSelect($cnx, $req);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Supprimer un candidat</title>
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
  
            <a href="Visu_tab_R.php">Résultat</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>

    <form action="../SCRIPTS/delete.php" method="POST">
        <select name="idCand">
            <option value="">--Choisir un étudiant--</option>
            <?php foreach($result as $ligne){?>
            <option value="<?php echo $ligne['idCarteEtudiant'] ?>"><?php echo $ligne['nom']." ".$ligne['prenom']." -- ".$ligne['label'] ?></option>
            <?php }?>
        </select>

        <input type="submit" value="supprimer">
    </form>
    <?php if(isset($_GET['error'])){?><p><?php echo $_GET['error'];?></p><?php }?>
</body>
</html>