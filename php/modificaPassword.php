<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "authUtil.php";
    require_once DIR_UTIL . "userDbManager.php";
    if(!$username=isLogged()) {
        header('location: ./home.php');
        exit();
    }
    
    $vecchiaPassword = $_POST['vecchiaPassword'];
    $nuovaPassword = $_POST['password'];
    
    $errorMessage = controllaPassword($username, $vecchiaPassword);
    if($errorMessage === null){
            cambiaPassword($username, $nuovaPassword);
            $confirm = 'Modifica avvenuta con successo';
            header('location: ./modificaPasswordForm.php?message=' . $confirm );
    }    
    else{
        $errorMessage = "La vecchia password non è corretta";
        header('location: ./modificaPasswordForm.php?message=' . $errorMessage );
    }
        
