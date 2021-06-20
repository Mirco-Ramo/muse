<?php
    require_once __DIR__ . "/costanti.php";
    session_start();
    
    session_destroy();
    header("Location: home.php");
    exit;
?>
