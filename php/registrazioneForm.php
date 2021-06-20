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
	<script type="text/javascript" src="../js/effects/sidenav.js"></script>  <!--dynamic sidenav-->
        <script type="text/javascript" src="../js/ajax/ajaxManager.js"></script>
        <script type="text/javascript" src="../js/ajax/uniLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/uniSelect.js"></script>
        <script type="text/javascript" src="../js/ajax/cdlLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/cdlSelect.js"></script>
        <script type="text/javascript" src="../js/formValidation/dynamicQuestions.js"></script> <!-- dynamic update of questions role-based-->
        
    </head>
    <body class="alloro">
        
        <?php
            include DIR_NAVIGATION . "mainNav.php";
        ?>
        
        <section id="register_content">
            <header id="register_content_header">
            </header>
            <div id="register_form">
                <form id="register" name="register" action="./registrazione.php" method="post">
                    <div>
                        <label>Indirizzo email: </label>
                        <input type="email" placeholder="lorem.ipsum@example.com" name="email" autocomplete="off" required autofocus>
                    </div>
                    <div>
                        <label>Username: </label>
                        <input type="text" placeholder="username" name="username" autocomplete="off" required>
                    </div>
                    <div>
                        <label>Password: </label>
                        <input type="password" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
                    <div>
                        <label>Conferma password: </label>
                        <input type="password" placeholder="Password" name="repassword" id="repassword" autocomplete="off" required>
                    </div>
                    <div>
                        <label>Nome: </label>
                        <input type="text" placeholder="nome" name="nome" required>
                    </div>
                    <div>
                        <label>Cognome: </label>
                        <input type="text" placeholder="cognome" name="cognome" required>
                    </div>
                    <div>
                        <label>Data di Nascita: </label>
                        <input type="date" name="dataNascita" required>
                    </div>
                    <div id="tipoUtente">
                        <label>Tipo di Utente: </label>
                        <input type="radio" name="tipo_utente" value="studente" onclick="mostraDomandeStudente()">Studente
                        <input type="radio" name="tipo_utente" value="tutor" onclick="mostraDomandeTutor()">Tutor                       
                    </div>
                </form>    
                
                    <?php
                        if (isset($_GET['errorMessage'])){
                            echo '<div class="register_error">';
                            echo '<span>' . $_GET['errorMessage'] . '</span>';
                            echo '</div>';
                        }
                    ?>

                <script type="text/javascript" src="../js/formValidation/registerValidation.js"></script> <!--validation script-->
            </div>
        </section>
        
        <?php
            include DIR_NAVIGATION . "footer.php";
        ?>   
    </body> 
</html>