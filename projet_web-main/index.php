<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS\style_index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <title>Login</title>
</head>
<body>
    <form action="SCRIPTS/verif_login3.php" method="POST">
        <fieldset>
            <legend>Login</legend>
            
            <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>

            <table>
                <tr>
                    <td><input type="text" name="login" placeholder="Adresse mail" title="Veuillez entrer votre adresse mail"></td>
                </tr>

                <tr>
                    <td><input type="password" name="password" placeholder="Mot de passe" title="Veuillez entrer votre mot de passe"></td>
                </tr>
            </table>
            <input type="submit">
        </fieldset>
    </form>
</body>
</html>