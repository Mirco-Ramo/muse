<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
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
        <link rel="shortcut icon" href="../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../css/Muse.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../css/popup.css" type="text/css" media="screen">
	<script type="text/javascript" src="../js/effects/sidenav.js"></script>  <!--dynamic sidenav-->        
    </head>
    <body>
        <?php
            if(isset($_GET['confirm'])){
                echo '<script type="text/javascript">';
                echo 'window.alert('; 
                echo '"' . $_GET['confirm'] . '"';
                echo ');';
                echo '</script>';        
            }
        ?>
        <header class="index_header">
            <img alt="Muse Logo" src="../img/logo.png">
        </header>
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <?php
            include DIR_NAVIGATION . "mainNav.php";
        ?>

        <section id="consultazione" class="odd">
            <div class="contenuto">
                <h2>Consulta le offerte delle Universit&aacute; Italiane</h2>
                <p>Con <strong>Muse</strong> puoi consultare oggi le offerte formative delle principali Universit&aacute; italiane
                    e scoprire la <em>carriera che pi&uacute; fa per te.</em></p>
                <p>Accedi all'<strong>Area di Ricerca</strong> e seleziona un Ateneo per scoprire tutti i Corsi di Laurea che puoi fare, 
                    oppure seleziona un Corso per vedere quali citt&aacute; potranno essere la prossima meta per i tuoi studi!</p>
            </div>
            <div class="color" id="yellow"></div>   
        </section>
        
        <section id="statistiche" class="even">
            <div class="contenuto">
                <h2>Confronta i dati e fai la scelta giusta!</h2>
                <p><strong>Muse</strong> ti permettere di confrontare i dati delle Universit&aacute;, come numero di studenti o 
                posizione nelle principali graduatorie; <br>
                Inoltre, di ogni Corso, sono presentate statistiche molto importanti, come
                il tempo medio di Laurea ed il tempo medio con cui gli studenti trovano lavoro</p>
            </div>
            <div class="color" id="light_blue"></div>
        </section>
        
        <section id="tutoraggio" class="odd">
            <div class="contenuto">
            <h2>Non sei ancora sicuro? Ti aiutiamo noi!</h2>
                <p>Hai ancora qualche incertezza? Nessun problema! <strong>Muse</strong> mette a tua disposizione, 
                    per ogni Corso di ogni Universit&aacute;, uno dei nostri tutor. <br>
                    Per qualsiasi domanda, richiedi un tutor tramite i link che troverai nell'<strong>Area di Ricerca</strong>
                    e contattalo quando vuoi con la chat che troverai nella tua Area Personale <strong>IL MIO MUSE</strong>.
                </p>
            </div>
            <div class="color" id="green"></div>
        </section>
        
        <?php
            include DIR_NAVIGATION . "footer.php";
        ?>
        
    </body>
</html>
