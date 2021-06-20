<?php
	
    //crea una nuova sessione con i parametri specificati
    function setSession($username, $email, $tipo_utente){
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['tipo_utente']=$tipo_utente;
    }

    //Controlla che sia stato fatto il login, se sì torna la chiave primaria (username)
    function isLogged(){		
        if(isset($_SESSION['username']))
            return $_SESSION['username'];
        else
            return false;
    }
    
    //Restituisce true se l'utente è un tutor, false se è studente
    function userIsTutor(){
        if(!isset($_SESSION['tipo_utente']))
            header('location: ../home.php?errorMessage=' . "Non è stato effettuato il login" );
        $tipo=$_SESSION['tipo_utente'];
        if($tipo=="tutor")
            return true;
        return false;        
    }
    
    //Restituisce true se l'utente è un amministratore, false se è studente
    function userIsAdmin(){
        if(!isset($_SESSION['tipo_utente']))
            header('location: ../home.php?errorMessage=' . "Non è stato effettuato il login" );
        $tipo=$_SESSION['tipo_utente'];
        if($tipo=="admin")
            return true;
        return false;        
    }

?>