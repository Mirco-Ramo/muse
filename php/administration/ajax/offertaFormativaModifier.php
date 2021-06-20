<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "cdlDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";
    
    if(!isset($_GET['modifyType'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $modifyType = $_GET['modifyType'];
    
    if($modifyType == 0){
        if (!isset($_GET['universita']) || !isset($_GET['corsoDiLaurea']) || !isset($_GET['campo']) || !isset($_GET['valore'])){
            echo json_encode(new AjaxResponse());
            return;
        }		
        
        $universita = $_GET['universita'];
        $corsoDiLaurea = $_GET['corsoDiLaurea'];
        $campo = $_GET['campo'];
        $valore = $_GET['valore'];

        $result= modifyOffertaFormativaData($universita, $corsoDiLaurea, $campo, $valore);
    }
    
    else if($modifyType == 1) {
        if (!isset($_GET['universita']) || !isset($_GET['corsoDiLaurea']) || !isset($_GET['votoMedio'])
            || !isset($_GET['tempoMedio']) || !isset($_GET['occupati1anno']) || !isset($_GET['occupati5anni'])){
            echo json_encode(new AjaxResponse());
            return;
        }
        
        $universita = $_GET['universita'];
        $corsoDiLaurea = $_GET['corsoDiLaurea'];
        $votoMedio = $_GET['votoMedio'];
        $tempoMedio = $_GET['tempoMedio'];
        $occupati1anno = $_GET['occupati1anno'];
        $occupati5anni = $_GET['occupati5anni'];
        
        $result = insertInOffertaFormativaDb($universita, $corsoDiLaurea, $votoMedio, $tempoMedio, $occupati1anno, $occupati5anni); 
    }
    

    $message = "OK";	
    echo json_encode(new AjaxResponse("0", $message));
    return;

?>