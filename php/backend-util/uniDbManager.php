<?php

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "dbConfig.php"; 			// classe con i parametri del database
    require_once  DIR_UTIL . "museDbmanager.php";
    $MuseDb = new MuseDbManager();                      // crea una nuova classe di amministrazione del database

function getUniNameList(){
    return searchInUniDb('nomeAteneo');
}

function getUniDataList(){
    return searchInUniDb('nomeAteneo', 'citta', 'link', 'nMatricole', 'miur', 'censis');
}

function searchInUniDb(){
    global $MuseDb;
    $parameters = '';
    for($i=0; $i<func_num_args(); $i++){
        $searchItem=$MuseDb->sqlInjectionFilter(func_get_arg($i));
        if($i>0)
            $parameters=$parameters . ' , ';
        $parameters=$parameters . $searchItem;
    }

    $queryText = 'SELECT ' . $parameters 
                . ' FROM universita ';

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function getUniData($nomeAteneo){
    global $MuseDb;
    $nomeAteneo=$MuseDb->sqlInjectionFilter($nomeAteneo);    

    $queryText = "SELECT * "  
                . "FROM universita "
                . "WHERE nomeAteneo='" . $nomeAteneo . "';";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function getAllUniData(){
    global $MuseDb;    

    $queryText = "SELECT * "  
                . "FROM universita; ";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function modifyUniData($nomeAteneo, $nomeAttributo, $nuovoValore){
    global $MuseDb;
    $nomeAteneo=$MuseDb->sqlInjectionFilter($nomeAteneo);
    $nomeAttributo=$MuseDb->sqlInjectionFilter($nomeAttributo);
    $nuovoValore=$MuseDb->sqlInjectionFilter($nuovoValore);

    $queryText = "UPDATE universita "  
                . "SET " . $nomeAttributo ."='" . $nuovoValore . "' " 
                . "WHERE nomeAteneo='" . $nomeAteneo . "';";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}

function insertInUniDb($nomeAteneo, $citta, $link, $nMatricole, $miur, $censis){
    global $MuseDb;
    $nomeAteneo=$MuseDb->sqlInjectionFilter($nomeAteneo);
    $citta=$MuseDb->sqlInjectionFilter($citta);
    $link=$MuseDb->sqlInjectionFilter($link);
    $nMatricole=$MuseDb->sqlInjectionFilter($nMatricole);
    $miur=$MuseDb->sqlInjectionFilter($miur);
    $censis=$MuseDb->sqlInjectionFilter($censis);

    $queryText = "INSERT INTO universita "  
                . "VALUES('" . $nomeAteneo . "', '" . $citta . "', '" . $link . "', '" . $nMatricole
                . "', '" . $miur . "', '" . $censis . "')";

    $result = $MuseDb->performQuery($queryText);
    $MuseDb->closeConnection();
    return $result;
}
