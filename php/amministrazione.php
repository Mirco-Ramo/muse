<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
    
    if (!isLogged() || !userIsAdmin()){
        header('Location: ./home.php');
        exit;
    }
    
    function esci(){
        header('Location: ./logout.php');
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
        <link rel="shortcut icon" href="../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../css/Muse.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../css/popup.css" type="text/css" media="screen"> 
        <script type="text/javascript" src="../js/ajax/ajaxManager.js"></script>
        <script>function exit(){
            AjaxManager.performAjaxRequest('GET', 'logout.php', false, null, null);
        }</script>
    </head>
    <body onbeforeunload="exit()">
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <div id="Admin_content">
            <aside id="Admin_aside">
                <h4 id="Admin_welcome">Benvenuto <em><?php echo isLogged()?></em>!</h4>
                <a class="Admin MyMuseOption" href="administration/gestisciUniversita.php" target="Admin_frame">Gestisci Universit&aacute;</a>
                <a class="Admin MyMuseOption" href="administration/gestisciCdl.php" target="Admin_frame">Gestisci Corsi di Laurea</a>
                <a class="Admin MyMuseOption" href="administration/gestisciOffertaFormativa.php" target="Admin_frame">Gestisci Offerta Formativa</a>
                <a class="Admin MyMuseOption" href="administration/rimuoviUtenti.php" target="Admin_frame">Rimuovi Utenti</a> 
            </aside>

            <iframe name="Admin_frame" id="Admin_frame" class="frame" src="administration/gestisciUniversita.php"></iframe>
        </div>       
        
    </body>
</html>
