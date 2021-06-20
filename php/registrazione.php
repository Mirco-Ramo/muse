<?php
    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "authUtil.php";
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $dataNascita = $_POST['dataNascita'];
    $tipo_utente = $_POST['tipo_utente'];
    
    if($tipo_utente==='tutor'){
        $universita = $_POST['universita'];
        $corsoDiLaurea = $_POST['corsoDiLaurea'];
        $annoIscrizione = $_POST['annoIscrizione'];
        $annoFrequenza = $_POST['annoFrequenza'];
    }
    else {
        $tipoScuola = $_POST['tipoScuola'];
        $nomeScuola = $_POST['nomeScuola'];
        $cittaScuola = $_POST['cittaScuola'];
        $provinciaScuola = $_POST['provinciaScuola'];
        $annoFrequentato = $_POST['annoFrequentato'];
    }

    $errorMessage = register($email, $username, $password, $nome, $cognome, $dataNascita, $tipo_utente,
                              $universita, $corsoDiLaurea, $annoIscrizione, $annoFrequenza,
                             $tipoScuola, $nomeScuola, $cittaScuola, $provinciaScuola, $annoFrequentato);
    if($errorMessage === null) {
        $errorMessage = login($username, $password, 'no');
        if($errorMessage === null) {
            $confirm = 'Registrazione completata';
            header('location: ./home.php?confirm=' . $confirm );
        }    
    }    
    else
        header('location: ./registrazioneForm.php?errorMessage=' . $errorMessage );
    
?>    