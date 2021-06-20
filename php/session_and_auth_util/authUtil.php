<?php

require_once __DIR__ . "/../costanti.php";
require_once DIR_SESSION . "sessionUtil.php"; //include le funzioni di utilità di sessione
require_once DIR_UTIL . "userDbManager.php"; //include le funzioni di utilità per l'autenticazione

function login($username, $password, $accessoAmministratore){   
    if ($username != null && $password != null){
            $tipo_utente = authenticate($username, $password);
        if ($tipo_utente==='err_not_found')
            return 'Username o password non validi';
        if($tipo_utente==='err_duplicate')
            return "Spiacente, si e' verificato un errore, si prega di contattare l'amministratore";
        if($tipo_utente === 'admin' && $accessoAmministratore !== 'yes')
            return "Username o password non validi";
        if($tipo_utente === 'admin' && $accessoAmministratore === 'yes'){
            session_start();
            setSession($username, $email, $tipo_utente);
            header('location: ./amministrazione.php');
            exit();
        }
        //utente normale
        if($accessoAmministratore === 'yes')
            return 'Utente non autorizzato ad accedere come amministratore';
        session_start();
        setSession($username, $email, $tipo_utente);
        return null;
    }

    return 'Si prega di inserire i campi richiesti';   
}



function register($email, $username, $password, $nome, $cognome, $dataNascita, $tipo_utente,
                          $universita, $corsoDiLaurea, $annoIscrizione, $annoFrequenza,
                         $tipoScuola, $nomeScuola, $cittaScuola, $provinciaScuola, $annoFrequentato){   
    if ($username==null || $password==null || $nome==null || $cognome==null || $dataNascita==null || $tipo_utente==null)
        return 'Si prega di inserire i campi richiesti';    
    if($tipo_utente==='tutor' && ($universita==null || $corsoDiLaurea==null || $annoIscrizione==null || $annoFrequenza==null))    
        return 'Si prega di inserire i campi richiesti';       
    if (alreadyRegistered($username))
        return "Questo username è già in uso";
    if (alreadyUsedEmail($email))
        return "Questa email è già in uso";       

    if($tipo_utente=='tutor'){
        insertInTutorDb($username, $universita, $corsoDiLaurea, $annoIscrizione, $annoFrequenza);
    }
    else if($tipo_utente=='studente'){
        insertInStudentDb($username, $tipoScuola, $nomeScuola, $cittaScuola, $provinciaScuola, $annoFrequentato);
    }
    else{
        return "Errore nella registrazione dell'utente: tipo utente inconsistente";
    }

    insertInUserDb($email, $username, $password, $nome, $cognome, $dataNascita, $tipo_utente);
    return null;       
}

