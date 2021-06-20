<?php
    session_start();
    require_once __DIR__ . "/../costanti.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_UTIL . "chatDbManager.php";
    require_once DIR_UTIL . "studentTutorInteractionDbManager.php";
    
    if(!isLogged() || !userIsAdmin()) {
        header('location: ../home.php');
        exit();
    }      
    
    $message = null;
    $page = './rimuoviUtenti.php';   
    
    if(!isset($_GET['username'])){
       $message = "Errore nel passaggio di parametri"; 
    }
        
    $username = $_GET['username'];


//associa i due utenti
    if($message === null){   //tutto ok 
        removeAllUserMessages($username);
        removeFromStudentDb($username);
        removeFromTutorDb($username);
        removeAllUserInteractions($username);
        removeFromUserDb($username);
        $message = 'Rimozione completata!';
    }        
    header('location: ' . $page . '?message=' . $message );
