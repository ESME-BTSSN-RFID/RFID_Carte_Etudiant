<?php
session_start();
$classe=$_GET['classe'];
if(isset($_SESSION['idUser'])){
    if (empty($_GET['classe'])){
        header("Location: ../PAGES/Visu_tab_IC.php?error=Veuillez compléter tous les champs");
        exit();
    }
    else{
        $classe = $_GET['classe'];
        
        header("Location: ../PAGES/Visu_tab_IC.php?classe=$classe");
        exit();
    }
}
else{
    header("Location: ../index.php");
}
?>