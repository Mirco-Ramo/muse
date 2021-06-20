<?php
    session_start();
    require_once __DIR__ . "/../costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
    
    if (!isLogged()){
        header('Location: ../home.php');
        exit;
    }
    if(!isset($_GET['contactName'])){
        header('Location: ./chatIndex.php');
        exit();
    }
    $contact=$_GET['contactName'];   
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>MUSE</title>
        <meta charset="UTF-8">
        <meta name="author" content="Mirco Ramo">
        <meta name="keywords" content="MUSE, Universit&aacute;, Tutor">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href = "../../img/icona.png" sizes="32x32" type="image/png">
        <link rel="shortcut icon" href="../../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../../css/chat.css" type="text/css" media="screen">
        <script type="text/javascript" src="../../js/effects/autoscroll.js"></script>
        <script>var MYNAME = "<?php echo isLogged();?>";</script>
        <script type="text/javascript" src="../../js/ajax/ajaxManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/messageDashboard.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/messageLoader.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/timerManager.js"></script>
        <script type="text/javascript" src="../../js/ajax/chat/chatManager.js"></script>
        
    </head>    
    <body onload="MessageLoader.loadAllMessages('<?php echo $contact;?>');
                  startUpdateTimer('<?php echo $contact;?>', 2000);" 
          onbeforeunload="stopUpdateTimer();">
        <div id="ajax_filled_messages" class="message_dashboard" onload="setTimeout(function() {goToBottom('ajax_filled_messages');}, 500);"></div>
        <textarea id="<?php echo $contact;?>_message_textarea" class="message_textarea"></textarea>
        <button type="button" class="send_button" onclick="MessageLoader.sendNewMessage('<?php echo $contact;?>');setTimeout(function() {goToBottom('ajax_filled_messages');}, 300);">
            Invia
        </button>                  
    </body>
    <script>setInterval(function() {goToBottom('ajax_filled_messages');}, 1000);</script>
</html>    
