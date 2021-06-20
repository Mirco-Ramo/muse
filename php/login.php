<?php

    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "authUtil.php";
 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $accessoAmministratore = $_POST['amministratore'];

    $errorMessage = login($username, $password, $accessoAmministratore);
    if($errorMessage === null){
            $confirm = 'Login completato';
            header('location: ./home.php?confirm=' . $confirm );
    }    
    else
        header('location: ./loginForm.php?errorMessage=' . $errorMessage );

?>    