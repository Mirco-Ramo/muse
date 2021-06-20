<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "authUtil.php";
    require_once DIR_UTIL . "userDbManager.php";
    if(!$username=isLogged()) {
        header('location: ./home.php');
        exit();
    }
    
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $dataNascita = $_POST['dataNascita'];

    $errorMessage = cambiaAnagrafica($username, $nome, $cognome, $dataNascita);
    if($errorMessage === null){
            $confirm = 'Modifica avvenuta con successo';
            header('location: ./modificaDatiForm.php?message=' . $confirm );
    }    
    else
        header('location: ./modificaDatiForm.php?message=' . $errorMessage );
