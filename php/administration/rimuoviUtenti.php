<?php
    session_start();
    require_once __DIR__ . "/../costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
    
    if (!isLogged() || !userIsAdmin()){
        header('Location: ./home.php');
        exit;
    }    
   
?>

<html lang="it">
    <head>
        <title>MUSE</title>
        <meta charset="UTF-8">
        <meta name="author" content="Mirco Ramo">
        <meta name="keywords" content="MUSE, Universit&aacute;, Tutor">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href = "../../img/icona.png" sizes="32x32" type="image/png">
        <link rel="shortcut icon" href="../../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../../css/Muse.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../../css/popup.css" type="text/css" media="screen"> 
        <script type="text/javascript" src="../../js/ajax/ajaxManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/userLoader.js"></script>
        <script type="text/javascript" src="../../js/ajax/userDashboard.js"></script>
    </head>
    <body>
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message'], true);
        ?>
        
        <input class="search" autocomplete="off" type="text" name="search" placeholder="Cerca utenti" onkeyup="UserLoader.searchUser(this.value);">
        <div id="ajax_filled_user"></div>
        
    </body>
</html>

