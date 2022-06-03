<?php
session_start();
if(isset($_SESSION['idUser'])){
    if (empty($_GET['classe']) || empty($_GET['week'])){
        header("Location: ../PAGES/Visu_tab_R.php?error=Veuillez compléter tous les champs");
        exit();
    }
    else{
        $classe = $_GET['classe'];
        $week = $_GET['week'];
        
        header("Location: ../PAGES/Visu_tab_R.php?classe=$classe&week=$week");
        exit();
    }
}
else{
    header("Location: ../index.php");
}
?>