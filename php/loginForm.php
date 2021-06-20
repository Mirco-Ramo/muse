<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    include DIR_SESSION . "sessionUtil.php";

    if (isLogged()){
        header('Location: ./home.php');
        exit;
    }	
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <title>MUSE</title>
        <meta charset="UTF-8">
        <meta name="author" content="Mirco Ramo">
        <meta name="keywords" content="MUSE, Universit&aacute;, Tutor">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href = "../img/icona.png" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="../css/Muse.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../css/popup.css" type="text/css" media="screen">
	<script type="text/javascript" src="../js/effects/sidenav.js"></script>  <!--dynamic sidenav-->
        
    </head>
    <body class="alloro">
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <?php
            include DIR_NAVIGATION . "mainNav.php";
        ?>
               
        <section id="sign_in_content">
            <header id="sign_in_content_header">
            </header>
            <div id="login_form">
                <form name="login" action="./login.php" method="post">
                    <div>
                        <label>Username: </label>
                        <input type="text" placeholder="Username" name="username" autocomplete="off" required autofocus>
                    </div>
                    <div>
                        <label>Password: </label>
                        <input type="password" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
                    <div id="accessoAmministratore">
                        <label>Accesso Amministratore: </label>
                        <input type="checkbox" name="amministratore" value="yes">
                    </div>
                    <input id="enter_login_button" type="submit" value="Accedi">
                    <?php
                        if (isset($_GET['errorMessage'])){
                            echo '<div class="sign_in_error">';
                            echo '<span>' . $_GET['errorMessage'] . '</span>';
                            echo '</div>';
                        }
                    ?>
                </form>
            </div>
            <div id="forgot_password">
                <p>Password dimenticata? Si prega di seguire la procedura indicata nella <a href="../html/GuidaEFaq.html">Guida</a></p>
            </div>
            <div id="nuovo_utente">
                <p>Se non hai ancora un account MUSE, <a href="registrazioneForm.php">clicca qui per registrarti</a></p>
            </div>
        </section>
        
        <?php
            include DIR_NAVIGATION . "footer.php";
        ?>
        
    </body>
</html>