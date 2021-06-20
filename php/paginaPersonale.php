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
	<script type="text/javascript" src="../js/effects/sidenav.js"></script>  <!--dynamic sidenav-->        
    </head>
    <body>
        
        <?php
            include DIR_NAVIGATION . "messageUtil.php";
            if(isset($_GET['message']))
                showMessage($_GET['message']);
        ?>
        
        <?php
            include DIR_NAVIGATION . "mainNav.php";
        ?>
        <div id="MyMuse_content">
            <aside id="MyMuse_aside">
                <h4 id="MyMuse_welcome">Benvenuto <em><?php echo isLogged()?></em>!</h4>
                <a class="MyMuseOption" href="modificaDatiForm.php" target="MyMuse_frame">Modifica anagrafica</a>
                <a class="MyMuseOption" href="modificaPasswordForm.php" target="MyMuse_frame">Modifica la password</a>
                <?php
                    if(!userIsTutor()){
                        echo '<a class="MyMuseOption" href="eliminaTutor.php" target="MyMuse_frame">Rimuovi un tutor</a>';
                        echo '<a class="MyMuseOption" href="votaTutor.php" target="MyMuse_frame">Vota un tutor</a>';
                    }
                        
                ?>
                <a class="MyMuseOption" href="chat/chatIndex.php" target="MyMuse_frame">Apri la chat</a> 
            </aside>

            <iframe name="MyMuse_frame" id="MyMuse_frame" class="frame" src="modificaDatiForm.php"></iframe>
        </div>
        <?php
            include DIR_NAVIGATION . "footer.php";
        ?>
        
    </body>
</html>
