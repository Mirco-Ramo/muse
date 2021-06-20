<?php

    require_once __DIR__ . "/../costanti.php";
    require DIR_UTIL . "dbConfig.php"; 			// classe con i parametri del database
    require_once DIR_UTIL . "museDbmanager.php";
    $MuseDb = new MuseDbManager();                      // crea una nuova classe di amministrazione del database

function getCdlNameList(){
    return searchInCdlDb('nome');
}

function getCdlDataList(){
    return searchInCdlDb('*');
}

function searchInCdlDb(){
    global $MuseDb;
    $parameters = '';
    for($i=0; $i<func_num_args(); $i++){
        $searchItem=$MuseDb->sqlInjectionFilter(func_get_arg($i));
        if($i>0)
            $parameters=$parameters . ' , ';
        $parameters=$parameters . $searchItem;
    }

    $queryText = 'SELECT ' . $parameters 
                . ' FROM corsodilaurea ';

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}


function getCorsiOfferti($universita){
    global $MuseDb;
    $universita=$MuseDb->sqlInjectionFilter($universita);
    
    $queryText = 'SELECT c.* FROM offertaformativa o INNER JOIN corsodilaurea c ON o.corsoDiLaurea=c.nome WHERE o.universita=\'' . $universita .'\';';
    
    $result = $MuseDb->performQuery($queryText);    
    $MuseDb->closeConnection();
    return $result;
}

function getOffertaFormativaData($universita, $corsoDiLaurea) {
    global $MuseDb;
    $universita=$MuseDb->sqlInjectionFilter($universita);
    $corsoDiLaurea=$MuseDb->sqlInjectionFilter($corsoDiLaurea);
    
    $queryText = 'SELECT * FROM offertaformativa ' 
            . 'WHERE universita=\'' . $universita .'\' AND corsoDiLaurea=\'' . $corsoDiLaurea . '\';';
    
    $result = $MuseDb->performQuery($queryText);    
    $MuseDb->closeConnection();
    return $result;
}

function getCdlData($nome) {
    global $MuseDb;
    $nome=$MuseDb->sqlInjectionFilter($nome);
    
    $queryText = 'SELECT * FROM corsodilaurea ' 
            . 'WHERE nome=\'' . $nome  . '\';';
    
    $result = $MuseDb->performQuery($queryText);    
    $MuseDb->closeConnection();
    return $result;
}

function getAllCdlData(){
    global $MuseDb;    

    $queryText = "SELECT * "  
                . "FROM corsodilaurea; ";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function modifyCdlData($nome, $nomeAttributo, $nuovoValore){
    global $MuseDb;
    $nome=$MuseDb->sqlInjectionFilter($nome);
    $nomeAttributo=$MuseDb->sqlInjectionFilter($nomeAttributo);
    $nuovoValore=$MuseDb->sqlInjectionFilter($nuovoValore);

    $queryText = "UPDATE corsodilaurea "  
                . "SET " . $nomeAttributo ."='" . $nuovoValore . "' " 
                . "WHERE nome='" . $nome . "';";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function insertInCdlDb($nome, $settore, $descrizione){
    global $MuseDb;
    $nome=$MuseDb->sqlInjectionFilter($nome);
    $settore=$MuseDb->sqlInjectionFilter($settore);
    $descrizione=$MuseDb->sqlInjectionFilter($descrizione);

    $queryText = "INSERT INTO corsodilaurea "  
                . "VALUES('" . $nome . "', '" . $settore . "', '" . $descrizione . "');";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function getAllOffertaFormativaData(){
    global $MuseDb;    

    $queryText = "SELECT * "  
                . "FROM offertaformativa; ";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function modifyOffertaFormativaData($universita, $corsoDiLaurea, $nomeAttributo, $nuovoValore){
    global $MuseDb;
    $universita=$MuseDb->sqlInjectionFilter($universita);
    $corsoDiLaurea=$MuseDb->sqlInjectionFilter($corsoDiLaurea);
    $nomeAttributo=$MuseDb->sqlInjectionFilter($nomeAttributo);
    $nuovoValore=$MuseDb->sqlInjectionFilter($nuovoValore);

    $queryText = "UPDATE offertaformativa "  
                . "SET " . $nomeAttributo ."='" . $nuovoValore . "' " 
                . "WHERE universita='" . $universita . "' AND corsodilaurea='" . $corsoDiLaurea . "';";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function insertInOffertaFormativaDb($universita, $corsoDiLaurea, $votoMedio, $tempoMedio, $occupati1anno, $occupati5anni){
    global $MuseDb;
    $universita=$MuseDb->sqlInjectionFilter($universita);
    $corsoDiLaurea=$MuseDb->sqlInjectionFilter($corsoDiLaurea);
    $votoMedio=$MuseDb->sqlInjectionFilter($votoMedio);
    $tempoMedio=$MuseDb->sqlInjectionFilter($tempoMedio);
    $occupati1anno=$MuseDb->sqlInjectionFilter($occupati1anno);
    $occupati5anni=$MuseDb->sqlInjectionFilter($occupati5anni);

    $queryText = "INSERT INTO offertaformativa "  
                . "VALUES('" . $universita . "', '" . $corsoDiLaurea . "', '" . $votoMedio . "', '"
                . $tempoMedio . "', '" . $occupati1anno . "', '" . $occupati5anni ."');";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}