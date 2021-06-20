<?php

    session_start();
    require_once __DIR__ . "/../costanti.php";
    include DIR_SESSION . "sessionUtil.php";

    if(!isLogged())
    {
        header("location:../home.php");
    }
?>

<html>  
    <head>
        <title>MUSE</title>
        <meta charset="UTF-8">
        <meta name="author" content="Mirco Ramo">
        <meta name="keywords" content="MUSE, Universit&aacute;, Tutor">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href = "../img/icona.png" sizes="32x32" type="image/png">
        <link rel="shortcut icon" href="../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../../css/chat.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../../css/popup.css" type="text/css" media="screen">
        <script type="text/javascript" src="../../js/ajax/chat/timerManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/chatManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/ajaxManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/contactLoader.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/contactDashboard.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/messageLoader.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/messageDashboard.js"></script>  
    </head>  
    <body onload='ContactLoader.loadMyContacts(<?php echo '"' . isLogged() . '"' ?>)'>  
        <div class="chat_container">
            <header>
                <h1 align="center">Benvenuto nella chat di MUSE</h1>
                <div class="first_row">
                    <h2>I tuoi Contatti</h2>
                    <p align="right">Ciao <?php echo isLogged(); ?>!</p>                   
                </div>
            </header>
            <div class="table-responsive" id="ajax_filled_contacts">    
            </div>
            <div id="dark_background_div"> <!--invisibile finchè non si apre una chat-->
                <div>
                    <iframe id="chat_frame"></iframe>
                    <span id="close_chat_frame" class="close" onclick="closeChat()">&times;</span>
                </div>
            </div>
        </div>	
    </body>  
</html>