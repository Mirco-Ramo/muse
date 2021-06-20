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
        <script type="text/javascript" src="../../js/ajax/uniLoader.js"></script>
        <script type="text/javascript" src="../../js/ajax/uniTable.js"></script>
    </head>
    <body onload="UniLoader.loadEverything()">
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <table>
            <thead>
               <th>Nome Ateneo</th>
               <th>Citt&aacute;</th>
               <th>Link</th>
               <th>Numero Matricole</th>
               <th>Pos. clas. MIUR</th>
               <th>Pos. clas. CENSIS</th>
            </thead>
            <tbody id="ajax_filled_uni">
                
            </tbody>
        </table>       
        
    </body>
</html>

