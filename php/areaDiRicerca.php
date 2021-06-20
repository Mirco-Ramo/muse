<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
?>
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
        <script type="text/javascript" src="../js/ajax/uniLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/uniSelect.js"></script>
        <script type="text/javascript" src="../js/ajax/cdlLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/cdlSelect.js"></script>
        <script type="text/javascript" src="../js/ajax/tutorLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/researchLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/researchDashboard.js"></script>
	<script type="text/javascript" src="../js/effects/sidenav.js"></script>  <!--dynamic sidenav-->        
    </head>
    <body onload='UniLoader.loadList()' class="fixed_background">
        
        <?php
            include DIR_NAVIGATION . "mainNav.php";
        ?>
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <header id="areaDiRicerca_header">
            <h1>Benvenuto nell'<em>Area di Ricerca</em> MUSE</h1>
            <p>Seleziona un Ateneo ed un Corso per iniziare</p>
            <form name="areaDiRicerca" action="backend-util/mostraDati.php" method="get" id="areaDiRicerca_form">
                <label>Universit&aacute;: </label>
                <select id="ajax_filled_uni" onchange="CdlLoader.loadList(this.value); ResearchDashboard.removeAllData();"> </select>    
                <label>Possibili Corsi Di Laurea: </label>
                <select id="ajax_filled_cdl" onchange="ResearchLoader.loadData()"> </select>
            </form>
        </header>
        
        <div id="uni_stats" class="stats_wrapper">   </div>   <!--Ajax filled-->
        <div id="cdl_stats" class="stats_wrapper">   </div>   <!--Ajax filled-->
        <div id="tutors" class="stats_wrapper">      </div>   <!--Ajax filled-->
        
        <?php
            include DIR_NAVIGATION . "footer.php";
        ?>
        
    </body>

