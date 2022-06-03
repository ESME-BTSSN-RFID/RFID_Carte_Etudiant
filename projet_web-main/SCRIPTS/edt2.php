<?php
session_start();
if(isset($_SESSION['idUser'])){
    if (empty($_GET['classe']) || empty($_GET['week'])){
        header("Location: ../PAGES/presence.php?error=Veuillez compléter tous les champs");
        exit();
    }
    else{
        $classe = $_GET['classe'];
        $week = $_GET['week'];
        
        header("Location: ../PAGES/presence.php?classe=$classe&week=$week");
        exit();
    }
}
else{
    header("Location: ../index.php");
}
?>