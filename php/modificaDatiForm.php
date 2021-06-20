<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    include DIR_SESSION . "sessionUtil.php";	
    
    if (!isLogged()){
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
        <link rel="shortcut icon" href="../img/favicon.ico" sizes="32x32" type="image/x-icon">
        <link rel="stylesheet" href="../css/Muse.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../css/popup.css" type="text/css" media="screen">
        <script type="text/javascript" src="../js/ajax/ajaxManager.js"></script>
        <script type="text/javascript" src="../js/ajax/userLoader.js"></script>
        <script type="text/javascript" src="../js/ajax/userDashboard.js"></script>
    </head>
    <body onload='<?php echo 'UserLoader.loadUserData("' . isLogged() . '")';?>'>
        
            <?php
                include DIR_NAVIGATION . "messageUtil.php";
                if(isset($_GET['message']))
                    showMessage($_GET['message']);
            ?>
            
            <form id="ajax_filled_form" name="modificaDati" action="modificaDati.php" method="post">
                <!-- filled with ajax-->
                <input type="submit">
                <input type="reset">
            </form>             
        <script type="text/javascript" src="../js/formValidation/registerValidation.js"></script> <!--validation script-->
    </body>
</html>
