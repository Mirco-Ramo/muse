<?php

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "museDbManager.php"; //include la classe del db

    function loadMyContacts($username){
        global $MuseDb;
        
        $username = $MuseDb->sqlInjectionFilter($username);
        $querystring = "SELECT DISTINCT u2.* " .
                       "FROM utente u1 INNER JOIN tutoraggio t ON u1.username=t.utente INNER JOIN utente u2 ON u2.username=t.tutor " .
                       "WHERE u1.username = '" . $username . "' " .
                       "UNION " .
                       "SELECT DISTINCT u1.* " .
                       "FROM utente u1 INNER JOIN tutoraggio t ON u1.username=t.utente INNER JOIN utente u2 ON u2.username=t.tutor " .
                       "WHERE u2.username = '". $username ."';";
        
        $result=$MuseDb->performQuery($querystring);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function loadNewMessages($sender, $receiver){
        global $MuseDb;
        
        $sender = $MuseDb->sqlInjectionFilter($sender);
        $receiver = $MuseDb->sqlInjectionFilter($receiver);
        
        $insideQuerystring = "SELECT * " .
                       "FROM messaggio " .
                       "WHERE from_utente='" . $sender . "' AND  to_utente='" . $receiver . "' AND stato=1 " .
                       "ORDER BY timestamp DESC " .
                       "LIMIT 500 ";
        
        $outsideQuerystring = "SELECT * " . 
                              "FROM (" . $insideQuerystring . ") AS d " .
                              "ORDER BY timestamp ASC;";
        
        $result=$MuseDb->performQuery($outsideQuerystring);
        $MuseDb->closeConnection();
        return $result;
    }
    
    
    function loadAllMessages($utente1, $utente2){
        global $MuseDb;
        
        $utente1 = $MuseDb->sqlInjectionFilter($utente1);
        $utente2 = $MuseDb->sqlInjectionFilter($utente2);
        
        $insideQuerystring = "SELECT * " .
                       "FROM messaggio " .
                       "WHERE (from_utente='" . $utente1 . "' AND  to_utente='" . $utente2 . "') " . 
                       "OR (from_utente='" . $utente2 . "' AND  to_utente='" . $utente1 . "') " . 
                       "ORDER BY timestamp DESC " .
                       "LIMIT 500 ";
        
        $outsideQuerystring = "SELECT * " . 
                              "FROM (" . $insideQuerystring . ") AS d " .
                              "ORDER BY timestamp ASC; ";
        
        $result=$MuseDb->performQuery($outsideQuerystring);
        $MuseDb->closeConnection();
        return $result;
    }

    function setReadMessages($sender, $receiver){
        global $MuseDb;
        
        $sender = $MuseDb->sqlInjectionFilter($sender);
        $receiver = $MuseDb->sqlInjectionFilter($receiver);
        
        $querystring = "UPDATE messaggio " .
                       "SET stato=0 " .
                       "WHERE from_utente = '". $sender ."' AND to_utente = '". $receiver ."' AND stato=1; ";
        
        $result=$MuseDb->performQuery($querystring);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function writeNewMessage($sender, $receiver, $msgText){
        global $MuseDb;
        
        $sender = $MuseDb->sqlInjectionFilter($sender);
        $receiver = $MuseDb->sqlInjectionFilter($receiver);
        
        $querystring = "INSERT INTO messaggio (from_utente, to_utente, msgText, timestamp, stato) " .
                       "VALUES('". $sender ."', '". $receiver ."', '". $msgText ."', current_timestamp, 1);";
        
        $MuseDb->performQuery($querystring);
        $MuseDb->closeConnection();
        $result=$MuseDb->performQuery("SELECT current_timestamp;");
        $MuseDb->closeConnection();
        return $result;
    }
    
    function removeAllUserMessages($username){
        global $MuseDb;
        
        $querystring = "DELETE FROM messaggio " .
                       "WHERE from_utente = '" . $username . "' OR to_utente='" . $username . "';";
        
        $result = $MuseDb->performQuery($querystring);
        $MuseDb->closeConnection();
        return $result;
    }
